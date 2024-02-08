<?php

namespace App\Livewire\Dashboard\HomeTMA;

use Livewire\Component;
use Livewire\Attributes\On;

class Grafica extends Component
{
    public $cds;
    public $resultado;

    #[On('updateDashHome')]
    public function updateInfo($filters){
        $this->cds = $filters['cds'];
    }

    #[On('updateHomeData')]
    public function updateData($data){
        $labels = [];
        $values = [];

        $arr = array_reduce($data, function($carry, $line){
            if(!isset($carry[$line['centro']])){
                $carry[$line['centro']] = 0;
            }

            if($line['tma_roto'] == 1){
                $carry[$line['centro']] += $line['tma_roto'];
            }

            return $carry;
        }, []);
        
        $labels = array_keys($arr);
        $values = array_values($arr);

        $this->dispatch('updateGraficaTiempoReal', ["labels" => $labels, "data" => $values]);
    }

    public function render()
    {
        return view('livewire.dashboard.home-t-m-a.grafica');
    }
}
