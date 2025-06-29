<?php

namespace App\Console;

use App\Models\JornadaWarehouse;
use App\Models\Plan;
use App\Models\Recorrido;
use App\Models\TotalAnomalias;
use App\Traits\GetCurrentHistoryTable;
use App\Traits\GetCurrentHomeTable;
use App\Traits\GetStaticData;
use App\Traits\GetTransactionalData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
            try {
                $this->updateTable();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateTable");
            }
        })->everyFiveMinutes();

        $schedule->call(function(){
            try {
                $this->updateHistory();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateHistory");
            }
        })->everyFiveMinutes();

        $schedule->call(function(){
            try {
                $this->updateMovils();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateMovils");
            }
            
            try {
                $this->updateChofers();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateChofers");
            }
            
            try {
                $this->updatePuntos();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updatePuntos");
            }
            
            try {
                $this->updateAyudantes();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateAyudantes");
            }
            
            try {
                $this->updateColaboradores();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateColaboradores");
            }

            try {
                $this->updatePlans();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updatePlans");
            }
            
            try {
                $this->updateRecorridos();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateRecorridos");
            }
            
            try {
                $this->updateWarehouse();
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateWarehouse");
            }

            try {
                $hoy = date('Y-m-d');
                $this->updateAnomalias($hoy, $hoy);
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - updateAnomalias");
            }
        })->everyFiveMinutes();

        $schedule->call(function(){
            try {
                Plan::whereRaw('fecha < current_date - 30')->delete();
                Recorrido::whereRaw('fecha < current_date - 30')->delete();
                JornadaWarehouse::whereRaw('fecha < current_date - 30')->delete();
                TotalAnomalias::whereRaw('fecha < current_date - 30')->delete();

                $this->updateRecorridos(1);
                $this->updateWarehouse(1);
            } catch (\Exception $e) {
                Log::warning("Scheduled task failed - daily cleanup");
            }
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
