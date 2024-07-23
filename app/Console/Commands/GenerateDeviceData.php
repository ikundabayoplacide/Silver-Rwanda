<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DeviceData;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Exception;
class GenerateDeviceData extends Command
{
    protected $signature = 'generate:devicedata';
    protected $description = 'Generate random device data and store it in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $data = [
            'DEVICE_ID' => rand(1, 100),
            'S_TEMP' => rand(10, 40),
            'S_HUM' => rand(10, 40),
            'A_TEMP' => rand(10, 40),
            'A_HUM' => rand(10, 40),
            'farmer_id' => rand(1, 50),
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
            $this->error('Validation failed: ' . implode(', ', $validator->errors()->all()));
            return;
        }

        try {
            DeviceData::create($data);

            $formattedData = json_encode($data, JSON_PRETTY_PRINT);

            $this->info('Device data generated and stored successfully:');
            $this->info($formattedData);

            Log::info('Device data generated: ' . $formattedData);
        } catch (QueryException $e) {
            $this->error('Failed to store device data: ' . $e->getMessage());
            Log::error('Failed to store device data: ' . $e->getMessage());
        } catch (Exception $e) {
            $this->error('An unexpected error occurred: ' . $e->getMessage());
            Log::error('An unexpected error occurred: ' . $e->getMessage());
        }
    }
}