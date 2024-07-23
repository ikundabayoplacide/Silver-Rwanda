<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GenerateDeviceDataJob;
use Illuminate\Support\Facades\Log;

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
        $this->info('Starting the data generation process...');

        while (true) {
            dispatch(new GenerateDeviceDataJob());

            $this->info('Job dispatched successfully.');

            // Sleep for 5 minutes (300 seconds)
            sleep(30);
        }
    }
}