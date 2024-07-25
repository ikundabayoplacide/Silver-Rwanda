<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateDeviceDataJob;
use App\Models\DeviceData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DeviceDataController extends Controller
{
    public function index(Request $request)
    {
        $data = DeviceData::all();
        if ($request->isMethod('post')) {
            $deviceId = $request->get('device_id');
            $deviceData = DeviceData::find($deviceId);

            if ($deviceData) {
                $deviceData->on_off = !$deviceData->on_off;  // Toggle on_off state
                $deviceData->device_state = $deviceData->on_off ? 2 : 3; // Update device_state based on on_off
                $deviceData->save();
            }
        }
        return view('device_data.index', compact('data'));
    }

    public function visual()
    {
        $data = DeviceData::select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')->get();
        return view('testchart', compact('data'));
    }

    public function create()
    {
        return view('device_data.create');
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

        $data = $request->all();
        if (!isset($data['device_state'])) {
            $data['device_state'] = 3;
        }
        if (!isset($data['on_off'])) {
            $data['on_off'] = true;
        }
        DeviceData::create($data);
        return redirect()->route('device_data.index')->with('success', 'Device data created successfully.');
    }

    public function show(DeviceData $device_data)
    {
        return view('device_data.show', compact('device_data'));
    }

    public function edit(DeviceData $device_data)
    {
        return view('device_data.edit', compact('device_data'));
    }

    public function update(Request $request, DeviceData $device_data)
    {
        $request->validate([
            'DEVICE_ID' => 'required',
            'S_TEMP' => 'required|numeric',
            'S_HUM' => 'required|numeric',
            'A_TEMP' => 'required|numeric',
            'A_HUM' => 'required|numeric',
            'device_state' => 'required|integer',
            'on_off' => 'required|boolean',
        ]);

        $data = $request->all();
        if (!isset($data['device_state'])) {
            $data['device_state'] = 3;
        }

        $device_data->update($data);

        return redirect()->route('device_data.index')->with('success', 'Device data updated successfully.');
    }

    public function destroy(DeviceData $device_data)
    {
        $device_data->delete();
        return redirect()->route('device_data.index')->with('success', 'Device data deleted successfully.');
    }


   // Add this method to your DeviceDataController
public function toggle($id)
{
    $deviceData = DeviceData::findOrFail($id);
    Log::info("Toggling state for device: $id, current state: $deviceData->device_state");
        $deviceData->device_state = $deviceData->device_state == 1 ? 2 : 1;
        $deviceData->save();
        Log::info("New state for device: $id, new state: $deviceData->device_state");
    return redirect()->route('device_data.index')->with('success', 'Device state changed!');
}

public function generateData()
{
    GenerateDeviceDataJob::dispatch();

    return response()->json(['message' => 'Device data generation job dispatched successfully.']);
}

}

 