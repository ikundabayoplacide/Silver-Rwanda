<?php

namespace App\Jobs;

use App\Models\DeviceData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Exception;

class GenerateDeviceDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $data = [
            'DEVICE_ID' => rand(1, 10),
            'S_TEMP' => rand(10, 70),
            'S_HUM' => rand(10, 70),
            'A_TEMP' => rand(10, 70),
            'A_HUM' => rand(10, 70),
            'farmer_id' => rand(1, 10),
        ];

        $validator = Validator::make($data, [
            'DEVICE_ID' => 'required|integer',
            'S_TEMP' => 'required|numeric',
            'S_HUM' => 'required|numeric',
            'A_TEMP' => 'required|numeric',
            'A_HUM' => 'required|numeric',
            'farmer_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed: ' . implode(', ', $validator->errors()->all()));
            return;
        }

        try {
            DeviceData::create($data);

            $formattedData = json_encode($data, JSON_PRETTY_PRINT);

            Log::info('Device data generated and stored successfully: ' . $formattedData);
        } catch (QueryException $e) {
            Log::error('Failed to store device data: ' . $e->getMessage());
        } catch (Exception $e) {
            Log::error('An unexpected error occurred: ' . $e->getMessage());
        }
    }
}