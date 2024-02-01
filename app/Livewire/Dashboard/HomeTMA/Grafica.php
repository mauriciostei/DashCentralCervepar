<?php

namespace App\Livewire\Dashboard\HomeTMA;

use App\Traits\AddTimeIntervals;
use App\Traits\GetCurrentTMATable;
use Livewire\Component;
use Livewire\Attributes\On;

class Grafica extends Component
{
    use GetCurrentTMATable;
    use AddTimeIntervals;

    public $cds;
    public $resultado;

    #[On('updateDashHome')]
    public function updateInfo($filters){
        $this->cds = $filters['cds'];
    }

    public function getInfo(){
        $data = [];
        $labels = [];

        foreach($this->cds as $cds):
            $cd = $cds['CD'];
            $value = 0;
            
            if($cds['visible']):
                $labels[] = $cds['CD'];
                foreach($this->getTMATableByCD($cd) as $line):
                    $value += $line->tma_roto;
                endforeach;

                $data[] = $value;
            endif;
        endforeach;

        $this->dispatch('updateGraficaTiempoReal', ["labels" => $labels, "data" => $data]);
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.home-t-m-a.grafica');
    }
}
