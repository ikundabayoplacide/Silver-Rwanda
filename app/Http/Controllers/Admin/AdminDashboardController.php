<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\cooperative;
use App\Models\DeviceData;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Hash;
use Illuminate\Support\Facades\Http;

class AdminDashboardController extends Controller
{

    public function dashboard(Request $request)
    {

        $data = DeviceData::select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')->get();

        // Format data for JavaScript
        $chartData = [];
        $inputitem = $request->all();
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
        if ($request->has(['name', 'email', 'password', 'role', 'address', 'phone', 'gender'])) {
            $inputitem = $request->all();
            $user = User::create([
                'name' => $inputitem['name'],
                'email' => $inputitem['email'],
                'password' => Hash::make($inputitem['password']),
                'role' => $inputitem['role'],
                'address' => $inputitem['address'],
                'phone' => $inputitem['phone'],
                'gender' => $inputitem['gender'],
            ]);
        }
        // the following is about weather

        $response = Http::get('http://api.openweathermap.org/data/2.5/weather?q=kigali,rwanda&APPID=e6263ec92d5b5931d3b061765a52c466');
        $weatherData = $response->json();

        // this following is about user pie chart
        $data = DB::table('users')->select(
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
        $data = DB::table('farmers')->select(
            DB::raw('gender as gender'),
            DB::raw('count(*) as number')
        )
            ->groupBy('gender')
            ->get();
        $FarmerData = [
            'female' => 0,
            'male' => 0,
        ];

        foreach ($data as $value) {
            if ($value->gender == 'female') {
                $FarmerData['female'] = $value->number;
            } elseif ($value->gender == 'male') {
                $genderData['male'] = $value->number;
            }
        }
        $users = User::all();
        $femaleCount = User::where('gender', 'female')->count();
        $maleCount = User::where('gender', 'male')->count();
        $totalCount = $users->count();
        $farmerCount = Farmer::count();
        $cooperativeCount = cooperative::count();
        $deviceCount = DeviceData::count();
        return view('admin.dashboard', compact('chartData', 'farmerCount', 'femaleCount', 'maleCount', 'cooperativeCount', 'deviceCount', 'users', 'totalCount', 'genderData', 'weatherData'));
    }
}
