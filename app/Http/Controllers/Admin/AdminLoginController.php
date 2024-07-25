<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeviceData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Farmer;
use App\Models\cooperative;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view("admin.login");
    }

    public function admincheck(Request $request)
    {
        $credentials = $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            if (in_array($user->role, ['admin', 'sedo', 'cooperative_manager'])) {
                Auth::login($user);

                // Fetch device data for the dashboard
                $data = DeviceData::select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')->get();
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
                if ($request->has(['name', 'email', 'password', 'role', 'address', 'phone','gender'])) {
                    $inputitem = $request->all();
                    $user = User::create([
                        'name' => $inputitem['name'],
                        'email' => $inputitem['email'],
                        'password' => Hash::make($inputitem['password']),
                        'role' => $inputitem['role'],
                        'address' => $inputitem['address'],
                        'phone' => $inputitem['phone'],
                        'gender'=> $inputitem['gender'],
                    ]);
                }
                $deviceIDs = DeviceData::select('DEVICE_ID')->distinct()->get()->pluck('DEVICE_ID');

                // Fetch data based on the selected DEVICE_ID
                $selectedDeviceID = $request->input('device_id');
                if ($selectedDeviceID) {
                    $data_Devices = DeviceData::where('DEVICE_ID', $selectedDeviceID)
                                      ->select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')
                                      ->get();

                    // Display the fetched data using dd
                    // dd($data_Devices);
                }
                // for weather data

                $response = Http::get('http://api.openweathermap.org/data/2.5/weather?q=kigali,rwanda&APPID=e6263ec92d5b5931d3b061765a52c466');
                $weatherData = $response->json();

                // this is for Users
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
              // for user
                $users = User::all();
                $femaleCount = User::where('gender', 'female')->count();
                $maleCount = User::where('gender', 'male')->count();
                $totalCount = $users->count();
                // for Farmer
                $farmers = Farmer::all();
                $femaleFarmersCount = Farmer::where('gender', 'female')->count();
                $maleFarmersCount = Farmer::where('gender', 'male')->count();
                $totalFarmerCount = $farmers->count();
                $farmerCount=Farmer::count();


                $cooperativeCount= cooperative::count();
                $deviceCount = DeviceData::count();
                return view('admin.dashboard', compact('chartData','farmerCount',
                'femaleCount','maleCount','totalCount','farmers','femaleFarmersCount','maleFarmersCount',
                'cooperativeCount','totalFarmerCount','deviceCount','users','genderData','weatherData','selectedDeviceID','deviceIDs'));
            }

    }}
public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('admin.login');
    }
}