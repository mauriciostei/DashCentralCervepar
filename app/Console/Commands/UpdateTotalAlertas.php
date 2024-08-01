<?php

namespace App\Console\Commands;

use App\Traits\GetTransactionalData;
use Illuminate\Console\Command;

class UpdateTotalAlertas extends Command
{
    use GetTransactionalData;

    protected $signature = 'TotalAnomalias {inicio?} {fin?}';

    protected $description = 'Actualiza un rango de días del total de alertas generadas (La fecha de inicio y fin debe ser enviada en el comando)';

    public function handle()
    {
        $hoy = date('Y-m-d');
        $ini = date('Y-m-d', strtotime($this->argument('inicio') ?? $hoy));
        $fin = date('Y-m-d', strtotime($this->argument('fin') ?? $hoy));

        $this->updateAnomalias($ini, $fin);

        return "Se ha procesado con éxito el rango de fechas $ini - $fin en el sistema";
    }
}
