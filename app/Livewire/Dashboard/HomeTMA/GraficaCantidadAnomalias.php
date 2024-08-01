<?php

namespace App\Livewire\Dashboard\HomeTMA;

use App\Enums\CDS;
use App\Models\TotalAnomalias;
use Livewire\Component;

class GraficaCantidadAnomalias extends Component
{
    public function getInfo(){
        $resultado = [];

        foreach(CDS::cases() as $cd):
            $value = TotalAnomalias::where('centro', $cd->value)->where('fecha', date('Y-m-d'))->first();
            $resultado[$cd->value] = $value ? $value->total : 0;
        endforeach;

        $labels = array_keys($resultado);
        $values = array_values($resultado);

        $this->dispatch('updateGraficaTotalAnomalias', ["labels" => $labels, "data" => $values]);
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.home-t-m-a.grafica-cantidad-anomalias');
    }
}
