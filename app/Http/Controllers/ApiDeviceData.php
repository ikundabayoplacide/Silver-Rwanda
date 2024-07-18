<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use Illuminate\Http\Request;

class ApiDeviceData extends Controller
{
    public function index()
    {
        $data = DeviceData::all();
        return response()->json($data);
    }

    public function visual()
    {
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
        return response()->json($device_data);
    }

    public function update(Request $request, DeviceData $device_data)
    {
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
        $device_data->delete();
        return response()->json(['success' => 'Device data deleted successfully.'
    ]);
    }
}
