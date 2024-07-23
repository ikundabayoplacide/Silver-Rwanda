<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ApiDeviceData extends Controller
{
    public function index()
    {

        if (!Auth::guard('api')->check()) {
            return response()->json(['message' => 'You must log in to access this resource.'], 401);
        }

        $data = DeviceData::all();
        return response()->json($data);
    }

    public function visual()
    {

        // if (!Auth::check()) {
        //     return response()->json(['message' => 'You must log in to access this resource.'], 401);
        // }

        if (!Auth::guard('api')->check()) {
            return response()->json(['message' => 'You must log in to access this resource.'], 401);
        }

        $data = DeviceData::select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'DEVICE_ID' => 'required',
            'S_TEMP' => 'required|numeric',
            'S_HUM' => 'required|numeric',
            'A_TEMP' => 'required|numeric',
            'A_HUM' => 'required|numeric',
        ]);

        $deviceData = DeviceData::create($request->all());
        return response()->json(['success' => 'Device data created successfully.', 'data' => $deviceData], 201);
    }

    public function show(DeviceData $device_data)
    {

        if (!Auth::check()) {
            return response()->json(['message' => 'You must log in to access this resource.'], 401);
        }

        return response()->json($device_data);
    }

    public function update(Request $request, DeviceData $device_data)
    {

        if (!Auth::check()) {
            return response()->json(['message' => 'You must log in to access this resource.'], 401);
        }

        $request->validate([
            'DEVICE_ID' => 'required',
            'S_TEMP' => 'required|numeric',
            'S_HUM' => 'required|numeric',
            'A_TEMP' => 'required|numeric',
            'A_HUM' => 'required|numeric',
        ]);

        $device_data->update($request->all());
        return response()->json(
            ['success' => 'Device data updated successfully.',
             'data' => $device_data]);
    }

    public function destroy(DeviceData $device_data)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'You must log in to access this resource.'], 401);
        }

        $device_data->delete();
        return response()->json(['success' => 'Device data deleted successfully.'
    ]);
    }

    public function randomDataSimulatin(){
        
    }
}