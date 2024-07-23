<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\GenerateDeviceData::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Schedule the command to run every 5 minutes
        $schedule->command('generate:devicedata')->everyFiveMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}