<?php

namespace App\Http\Controllers;

use App\Models\DeviceData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighChartController extends Controller
{
    public function handleChart()
    {
        $userData = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        dd("userData ", $userData);

        // Ensure we have 12 entries for each month
        $formattedData = array_fill(0, 12, 0);

        foreach ($userData as $data) {
            $formattedData[$data->month - 1] = $data->count;
        }

        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        return view('home', compact('formattedData', 'months'));
    }
    public function visual()
    {
        $data = DeviceData::select('DEVICE_ID', 'S_TEMP', 'S_HUM', 'A_TEMP', 'A_HUM', 'created_at')->get();

        // Format data for JavaScript
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
        

        return view('testChart', compact('chartData'));
    }
}