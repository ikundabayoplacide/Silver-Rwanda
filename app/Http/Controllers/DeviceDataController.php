<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use Illuminate\Http\Request;

class DeviceDataController extends Controller
{
    public function index()
    {
        $data = DeviceData::all();
        return view('device_data.index', compact('data'));
    }


    public function visual()
    {
        $data = DeviceData::select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')->get();
        // dd($data);

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
        if (!isset($data['device_status'])) {
            $data['device_status'] = 3;
        }

        DeviceData::create($request->all());
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
            'device_status'== 3,
        ]);
        $data = $request->all();
        if (!isset($data['device_status'])) {
            $data['device_status'] = 3;
        }
 
        $device_data->update($request->all());

        return redirect()->route('device_data.index')->with('success', 'Device data updated successfully.');
    }

    public function destroy(DeviceData $device_data)
    {
        $device_data->delete();
        return redirect()->route('device_data.index')->with('success', 'Device data deleted successfully.');

   }
}