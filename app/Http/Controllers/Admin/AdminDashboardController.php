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
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Log;
use Phpml\Regression\LeastSquares;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // Fetch data
        $data = $this->fetchDashboardData($request);

        // Pass data to view
        return view('admin.dashboard', $data);
    }

    private function fetchDashboardData(Request $request)
    {
        $selectedDeviceID = $request->input('device_id');
        $deviceIDs = DeviceData::select('DEVICE_ID')->distinct()->get()->pluck('DEVICE_ID');
        $data = $this->fetchDeviceData($selectedDeviceID);
        $chartData = $this->prepareChartData($data);

        $this->handleUserCreation($request);

        $weatherData = $this->fetchWeatherData();
        $genderData = $this->fetchGenderData('users');
        $femaleCount = $genderData['female'];
        $farmerGenderData = $this->fetchGenderData('farmers');
        $deviceStateData = $this->fetchDeviceStateData();


        // dd($deviceStateData['3']);


        $users = User::all();
        $users=User::paginate(6);
        $farmers = Farmer::all();
        $devices = DeviceData::all();
        $cooperativeCount = Cooperative::count();
        $deviceCount = DeviceData::count();
        $farmerCount = Farmer::count();
        $userCount = User::count();

        // Call the method to update predicted irrigation amounts
        $dataMAchine=$this->updatePredictedIrrigation();
        $inputData=$dataMAchine['inputData'];
        $predictedIrrigation=$dataMAchine['predictedIrrigation'];

        return compact(
            'chartData',
            'inputData',
            'data',
            'farmers',
            'users',
            'cooperativeCount',
            'deviceCount',
            'genderData',
            'weatherData',
            'deviceStateData',
            'farmerGenderData',
            'selectedDeviceID',
            'predictedIrrigation',
            'deviceIDs',
            'userCount',
            'farmerCount'
        );
    }

    private function fetchDeviceData($selectedDeviceID)
    {
        return $selectedDeviceID ? DeviceData::where('DEVICE_ID', $selectedDeviceID)
            ->select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')
            ->get() : collect([]);
    }

    private function prepareChartData($data)
    {
        return $data->map(function ($row) {
            return [
                'date' => $row->created_at->format('Y-m-d H:i:s'),
                'DEVICE_ID' => $row->DEVICE_ID,
                'S_TEMP' => $row->S_TEMP,
                'S_HUM' => $row->S_HUM,
                'A_TEMP' => $row->A_TEMP,
                'A_HUM' => $row->A_HUM,
            ];
        })->toArray();
    }

    private function handleUserCreation(Request $request)
    {
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
    }

    private function fetchWeatherData()
    {
        $response = Http::get('http://api.openweathermap.org/data/2.5/weather?q=kigali,rwanda&APPID=e6263ec92d5b5931d3b061765a52c466');
        return $response->json();
    }

    private function fetchGenderData($table)
    {
        return DB::table($table)->select(
            DB::raw('gender as gender'),
            DB::raw('count(*) as number')
        )->groupBy('gender')
            ->get()
            ->reduce(function ($carry, $item) {
                $carry[$item->gender] = $item->number;
                return $carry;
            }, ['female' => 0, 'male' => 0]);
    }

    private function fetchDeviceStateData()
    {
        return DB::table('device_data')->select(
            DB::raw('device_state as device_state'),
            DB::raw('count(*) as number')
        )->groupBy('device_state')
            ->get()
            ->reduce(function ($carry, $item) {
                $carry[$item->device_state] = $item->number;
                return $carry;
            }, ['function' => 0, 'non_function' => 0, 'InStock' => 0]);
    }

    private function updatePredictedIrrigation()
    {
        $dataset_devices = DeviceData::all()->toArray();

        if (empty($dataset_devices)) {
            return ['error' => 'Data not found.'];
        }

        $samples = [];
        $targets = [];

        // Prepare samples and targets for training
        foreach ($dataset_devices as $row) {
            $samples[] = [
                $row['S_TEMP'],
                $row['S_HUM'],
                $row['A_TEMP'],
                $row['A_HUM']
            ];
            $targets[] = $row['PRED_AMOUNT'];  // The target is the predicted irrigation amount
        }

        // Train the regression model
        $regression = new LeastSquares();
        $regression->train($samples, $targets);

        // Initialize inputData and predictedIrrigation variables
        $inputData = [];
        $predictedIrrigation = null;

        // Iterate over each row in the dataset and make predictions
        foreach ($dataset_devices as $row) {
            if (isset($row['S_TEMP'], $row['S_HUM'], $row['A_TEMP'], $row['A_HUM'])) {
                $inputData = [
                    $row['S_TEMP'],
                    $row['S_HUM'],
                    $row['A_TEMP'],
                    $row['A_HUM']
                ]; // Define inputData
                $predictedIrrigation = $regression->predict($inputData);

                // Update the DeviceData record with the predicted irrigation amount
                DeviceData::where('id', $row['id'])  // Assuming the first column is the ID
                    ->update(['PRED_AMOUNT' => $predictedIrrigation]);
            }
        }

        // Optionally return the last prediction and other data for further processing
        return compact('predictedIrrigation', 'inputData', 'samples', 'targets');
    }
}
