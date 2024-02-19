<?php

namespace App\Livewire\Dashboard\HomeTMA;

use App\Models\CurrentData;
use Livewire\Component;
use Livewire\Attributes\On;

class Grafica extends Component
{
    public $centros = [];
    public $resultado;

    #[On('updateFiltercentro')]
    public function updateCentros($filters){
        $this->centros = $filters;
    }

    public function getInfo(){
        $labels = [];
        $values = [];

        $this->resultado = [];
        foreach($this->centros as $line):
            $this->resultado[$line] = 0;
        endforeach;

        $data = CurrentData::whereIn('centro', $this->centros)->get();
        foreach($data as $line):
            if($line->tma_roto){
                $this->resultado[$line->centro]++;
            }
        endforeach;

        $labels = array_keys($this->resultado);
        $values = array_values($this->resultado);

        $this->dispatch('updateGraficaTiempoReal', ["labels" => $labels, "data" => $values]);
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.home-t-m-a.grafica');
    }
}
