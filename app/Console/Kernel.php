<?php

namespace App\Console;

use App\Traits\GetCurrentHistoryTable;
use App\Traits\GetCurrentHomeTable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    use GetCurrentHomeTable, GetCurrentHistoryTable;
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function(){
            $this->updateTable();
        })->everyFiveMinutes();
        // })->everyMinute();

        $schedule->call(function(){
            $this->updateHistory();
        })->everyFiveMinutes();
        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
