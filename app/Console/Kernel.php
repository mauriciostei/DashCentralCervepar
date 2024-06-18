<?php

namespace App\Console;

use App\Models\Plan;
use App\Models\Recorrido;
use App\Traits\GetCurrentHistoryTable;
use App\Traits\GetCurrentHomeTable;
use App\Traits\GetStaticData;
use App\Traits\GetTransactionalData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    use GetCurrentHomeTable, GetCurrentHistoryTable, GetStaticData, GetTransactionalData;
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function(){
            $this->updateTable();
        })->everyFiveMinutes();

        $schedule->call(function(){
            $this->updateHistory();
        })->everyFiveMinutes();

        $schedule->call(function(){
            $this->updateMovils();
            $this->updateChofers();
            $this->updatePuntos();
            $this->updateAyudantes();

            $this->updatePlans();
            $this->updateRecorridos();
        })->everyFiveMinutes();

        $schedule->call(function(){
            Plan::whereRaw('fecha < current_date - 30')->delete();
            Recorrido::whereRaw('fecha < current_date - 30')->delete();

            $this->updateRecorridos(1);
        })->daily();
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
