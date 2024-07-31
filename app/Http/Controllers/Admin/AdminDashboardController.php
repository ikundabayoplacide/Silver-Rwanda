<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\Cooperative;
use App\Models\DeviceData;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Phpml\Regression\LeastSquares;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $inputData = [];
        // Get distinct device IDs
        $deviceIDs = DeviceData::select('DEVICE_ID')->distinct()->get()->pluck('DEVICE_ID');

        // Fetch data based on the selected DEVICE_ID
        $selectedDeviceID = $request->input('device_id');
        $data = [];

        if ($selectedDeviceID) {
            $data = DeviceData::where('DEVICE_ID', $selectedDeviceID)
                ->select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')
                ->get();
        }

        // Prepare chart data for JavaScript
        $chartData = [];
        foreach ($data as $row) {
            $chartData[] = [
                'date' => $row->created_at->format('Y-m-d H:i:s'),
                'DEVICE_ID' => $row->DEVICE_ID,
                'S_TEMP' => $row->S_TEMP,
                'S_HUM' => $row->S_HUM,
                'A_TEMP' => $row->A_TEMP,
                'A_HUM' => $row->A_HUM,
            ];
        }

        // Handle user creation
        if ($request->has(['name', 'email', 'password', 'role', 'address', 'phone', 'gender'])) {
            $inputitem = $request->all();
            User::create([
                'name' => $inputitem['name'],
                'email' => $inputitem['email'],
                'password' => Hash::make($inputitem['password']),
                'role' => $inputitem['role'],
                'address' => $inputitem['address'],
                'phone' => $inputitem['phone'],
                'gender' => $inputitem['gender'],
            ]);
        }

        // Fetch weather data
        $response = Http::get('http://api.openweathermap.org/data/2.5/weather?q=kigali,rwanda&APPID=e6263ec92d5b5931d3b061765a52c466');
        $weatherData = $response->json();

        // Fetch user gender data
        $genderData = $this->fetchGenderData('users');

        // Fetch farmer gender data
        $Farmerdata = $this->fetchGenderData('farmers');

        // Fetch device state data
        $Devicedata = $this->fetchDeviceStateData();

        // Fetch user counts
        $users = User::all();
        $femaleCount = User::where('gender', 'female')->count();
        $maleCount = User::where('gender', 'male')->count();
        $totalCount = $users->count();

        // Fetch farmer counts
        $farmers = Farmer::all();
        $femaleFarmersCount = Farmer::where('gender', 'female')->count();
        $maleFarmersCount = Farmer::where('gender', 'male')->count();
        $totalFarmerCount = $farmers->count();
        $farmerCount = Farmer::count();

        // Fetch device counts
        $Devices = DeviceData::all();
        $functionCount = DeviceData::where('device_state', 'function')->count();
        $nonFunctionCount = DeviceData::where('device_state', 'non_function')->count();
        $InStock = DeviceData::where('device_state', 'InStock')->count();
        $totalDeviceCount = $Devices->count();
        $data_Devices = DeviceData::all();
        $cooperativeCount = Cooperative::count();
        $deviceCount = DeviceData::count();

        // Machine learning prediction
        $predictionData = $this->machineLearningPrediction();

        $predictionData = $this->machineLearningPrediction();

        // Ensure $predictedIrrigation and $inputData are set
        $predictedIrrigation = $predictionData['predictedIrrigation'] ?? null;
        $inputData = $predictionData['inputData'] ?? [];

        if (isset($predictionData['inputData'])) {
            $inputData = $predictionData['inputData'];
        }

        return view(
            'admin.dashboard',
            compact(
                'chartData',
                'data_Devices',
                'farmerCount',
                'femaleCount',
                'maleCount',
                'cooperativeCount',
                'deviceCount',
                'users',
                'totalCount',
                'genderData',
                'weatherData',
                'functionCount',
                'nonFunctionCount',
                'InStock',
                'totalDeviceCount',
                'farmers',
                'femaleFarmersCount',
                'maleFarmersCount',
                'totalFarmerCount',
                'Farmerdata',
                'selectedDeviceID',
                'deviceIDs',
                'predictionData',
                'inputData',
                'predictedIrrigation'
            )
        );
    }

    private function fetchGenderData($table)
    {
        $data = DB::table($table)->select(
            DB::raw('gender as gender'),
            DB::raw('count(*) as number')
        )
            ->groupBy('gender')
            ->get();

        $genderData = [
            'female' => 0,
            'male' => 0,
        ];

        foreach ($data as $value) {
            if ($value->gender == 'female') {
                $genderData['female'] = $value->number;
            } elseif ($value->gender == 'male') {
                $genderData['male'] = $value->number;
            }
        }

        return $genderData;
    }

    private function fetchDeviceStateData()
    {
        $data = DB::table('device_data')->select(
            DB::raw('device_state as device_state'),
            DB::raw('count(*) as number')
        )
            ->groupBy('device_state')
            ->get();

        $Devicedata = [
            'function' => 0,
            'non_function' => 0,
            'InStock' => 0,
        ];

        foreach ($data as $value) {
            if ($value->device_state == 'function') {
                $Devicedata['function'] = $value->number;
            } elseif ($value->device_state == 'non_function') {
                $Devicedata['non_function'] = $value->number;
            } elseif ($value->device_state == 'InStock') {
                $Devicedata['InStock'] = $value->number;
            }
        }

        return $Devicedata;
    }

    private function machineLearningPrediction()
    {
        $predictedIrrigation = null;
        $dataset_devices = DeviceData::all()->toArray();
        $dataset_devices_csv = $this->exportToCsv($dataset_devices);

        if (!$dataset_devices_csv) {
            return response()->json(['error' => 'data not found.'], 404);
        }

        $data = array_map('str_getcsv', file($dataset_devices_csv));
        $header = array_shift($data);

        $samples = [];
        $targets = [];

        foreach ($data as $row) {
            if (count($row) < 6) {
                continue;
            }
            $samples[] = array_slice($row, 1, 4);
            $targets[] = $row[5];
        }

        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        $latestData = end($data);

        if (count($latestData) >= 5) {
            $inputData = array_slice($latestData, 1, 4);
            $predictedIrrigation = $regression->predict($inputData);
            return compact('predictedIrrigation', 'inputData', 'samples', 'targets');
        } else {
            return response()->json(['error' => 'Not enough data for prediction.'], 400);
        }
    }

    private function exportToCsv($data)
    {
        $fileName = 'device_data.csv';
        $filePath = storage_path('app/' . $fileName);

        $file = fopen($filePath, 'w');

        if ($file === false) {
            return false;
        }

        if (!empty($data)) {
            fputcsv($file, array_keys($data[0]));
        }

        foreach ($data as $row) {
            fputcsv($file, $row);
        }

        fclose($file);

        return $filePath;
    }
}
