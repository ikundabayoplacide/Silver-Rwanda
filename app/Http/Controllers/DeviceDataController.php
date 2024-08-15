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
        $deviceIDs = DeviceData::select('DEVICE_ID')->distinct()->get()->pluck('DEVICE_ID');
        $selectedDeviceID = $request->input('device_id');
        $data = $this->fetchDeviceData($selectedDeviceID);

        if ($request->isMethod('post')) {
            $deviceId = $request->get('device_id');
            $deviceData = DeviceData::find($deviceId);

            if ($deviceData) {
                $deviceData->on_off = !$deviceData->on_off;  // Toggle on_off state
                $deviceData->device_state = $deviceData->on_off ? 2 : 3; // Update device_state based on on_off
                $deviceData->save();
            }
        }

        return view('device_data.index', compact('data', 'deviceIDs', 'selectedDeviceID'));
    }

    private function fetchDeviceData($selectedDeviceID)
    {
        return $selectedDeviceID ? DeviceData::where('DEVICE_ID', $selectedDeviceID)
            ->select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'PRED_AMOUNT', 'created_at')
            ->paginate(10) : DeviceData::paginate(10);
    }

    public function display(Request $request)
    {
        $selectedDeviceID = $request->input('device_id');

        $deviceIDs = DeviceData::select('DEVICE_ID')->distinct()->get()->pluck('DEVICE_ID');
        $data = $this->fetchDeviceData($selectedDeviceID);

        if ($request->has('download')) {
            $format = $request->get('download');

            $selectedDeviceID = $request->input('device_id');
            $exportData = $selectedDeviceID
                ? DeviceData::where('DEVICE_ID', $selectedDeviceID)
                ->select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'PRED_AMOUNT', 'created_at')
                ->get()
                : $data->getCollection();

            if ($format === 'pdf') {
                $pdf = Pdf::loadView('device_data.pdf', ['data' => $exportData]);
                return $pdf->download('device_data.pdf');
            } elseif ($format === 'excel') {
                return Excel::download(new DeviceDataExport($exportData), 'device_data.xlsx');
            } elseif ($format === 'csv') {
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

        return view('device_data.visualizeData', compact('data', 'deviceIDs', 'selectedDeviceID'));
    }

    protected function downloadPdf($data)
    {
        $pdf = Pdf::loadView('device_data.pdf', compact('data'));
        return $pdf->download('device_data.pdf');
    }

    protected function downloadExcel($data)
    {
        return Excel::download(new DeviceDataExport($data), 'device_data.xlsx');
    }

    public function visual()
    {
        $data = DeviceData::select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'PRED_AMOUNT', 'created_at')->get();
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
        $data = DeviceData::where('Device_ID', $device_id)->get();
        return view('device_data.index', compact('data', 'device_id'));
    }
}
