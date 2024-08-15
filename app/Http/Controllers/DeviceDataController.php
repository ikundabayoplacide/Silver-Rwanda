<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateDeviceDataJob;
use App\Models\DeviceData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DeviceDataExport;

class DeviceDataController extends Controller
{
    public function index(Request $request)
    {
        // Get the selected device ID from the request
        $selectedDeviceID = $request->input('device_id');

        // Fetch distinct device IDs for the dropdown filter
        $deviceIDs = DeviceData::select('DEVICE_ID')->distinct()->get()->pluck('DEVICE_ID');

        // Fetch data based on selected device ID
        $data = $selectedDeviceID
            ? DeviceData::where('DEVICE_ID', $selectedDeviceID)->paginate(10)
            : DeviceData::paginate(10);

        // Return the view with data and filter options
        return view('device_data.index', compact('data', 'deviceIDs', 'selectedDeviceID'));
    }
    public function display(Request $request)
    {
        $selectedDeviceID = $request->input('device_id');

        // Fetch distinct device IDs for the dropdown filter
        $deviceIDs = DeviceData::select('DEVICE_ID')->distinct()->get()->pluck('DEVICE_ID');

        // Fetch data based on selected device ID
        $data = $this->fetchDeviceData($selectedDeviceID);

        if ($request->has('download')) {
            $format = $request->get('download');

            // Filter data based on selected device ID for export
            $exportData = $selectedDeviceID
                ? DeviceData::where('DEVICE_ID', $selectedDeviceID)
                    ->select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'PRED_AMOUNT', 'created_at')
                    ->get()
                : $data->getCollection();

            if ($format === 'pdf') {
                // Load the filtered data for PDF export
                $pdf = Pdf::loadView('device_data.pdf', ['data' => $exportData]);
                return $pdf->download('device_data.pdf');
            } elseif ($format === 'excel') {
                // Pass filtered data to the export class
                return Excel::download(new DeviceDataExport($exportData), 'device_data.xlsx');
            } elseif ($format === 'csv') {
                // Convert filtered data to CSV format
                $csvData = $exportData->map(function ($item) {
                    return implode(',', [
                        $item->DEVICE_ID,
                        $item->S_TEMP,
                        $item->S_HUM,
                        $item->A_TEMP,
                        $item->A_HUM,
                        $item->PRED_AMOUNT
                    ]);
                })->implode("\n");

                return response($csvData)
                    ->header('Content-Type', 'text/csv')
                    ->header('Content-Disposition', 'attachment; filename="device_data.csv"');
            }
        }

        // Return the view with data and filter options
        return view('device_data.visualizeData', compact('data', 'deviceIDs', 'selectedDeviceID'));
    }


    private function fetchDeviceData($selectedDeviceID)
    {
        return $selectedDeviceID ? DeviceData::where('DEVICE_ID', $selectedDeviceID)
            ->select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'PRED_AMOUNT', 'created_at')
            ->paginate(10) : DeviceData::paginate(10);
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
            'PRED_AMOUNT' => 'numeric'
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
            'PRED_AMOUNT' => 'numeric'
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

    public function showByDeviceId($device_id)
    {
        $data = DeviceData::where('DEVICE_ID', $device_id)->get();
        return view('device_data.index', compact('data', 'device_id'));
    }

    public function delete($device_id)
    {
        $devices = DeviceData::where('DEVICE_ID', $device_id)->get();

        // Check if there are any devices to delete
        if ($devices->isEmpty()) {
            return redirect()->route('device_data.index')->with('error', 'No data found for this device ID.');
        }

        DeviceData::where('DEVICE_ID', $device_id)->delete();
        return redirect()->route('device_data.index')->with('success', 'Device data deleted successfully.');
    }
}
