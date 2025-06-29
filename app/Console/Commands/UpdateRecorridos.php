<?php

namespace App\Console\Commands;

use App\Traits\GetTransactionalData;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateRecorridos extends Command
{
    use GetTransactionalData;

    protected $signature = 'recorridos {fecha?}';

    protected $description = 'Actualiza un dia en el recorrido (La fecha debe ser enviada en el comando)';

    public function handle()
    {
        try {
            $hoy = date('Y-m-d');
            $fecha = date('Y-m-d', strtotime($this->argument('fecha') ?? $hoy));

            $diff = strtotime($hoy) - strtotime($fecha);
            $days = round($diff / (60 * 60 * 24));

            $this->updateRecorridos($days);

            return "Se ha procesado con éxito la fecha $fecha en el sistema";
        } catch (\Exception $e) {
            Log::warning("Command failed - UpdateRecorridos");
            return "Error al procesar la fecha $fecha en el sistema";
        }
    }
}
