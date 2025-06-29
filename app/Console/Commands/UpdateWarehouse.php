<?php

namespace App\Console\Commands;

use App\Traits\GetTransactionalData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateWarehouse extends Command
{
    use GetTransactionalData;

    protected $signature = 'warehouse {fecha?}';

    protected $description = 'Actualiza un dia en la jornada del warehouse (La fecha debe ser enviada en el comando)';

    public function handle()
    {
        try {
            $hoy = date('Y-m-d');
            $fecha = date('Y-m-d', strtotime($this->argument('fecha') ?? $hoy));

            $diff = strtotime($hoy) - strtotime($fecha);
            $days = round($diff / (60 * 60 * 24));

            $this->updateWarehouse($days);

            return "Se ha procesado con éxito la fecha $fecha en el sistema";
        } catch (\Exception $e) {
            Log::warning("Command failed - UpdateWarehouse");
            return "Error al procesar la fecha $fecha en el sistema";
        }
    }
}
