<?php

namespace App\Livewire\Dashboard\AlertasTMA;

use App\Enums\CDS;
use App\Traits\AddTimeIntervals;
use App\Traits\GetTimeLose;
use Livewire\Component;
use Livewire\Attributes\On;

class TiempoPerdido extends Component
{
    use GetTimeLose;
    use AddTimeIntervals;

    public $ini;
    public $fin;
    public $cds;

    public $tiempo;

    #[On('updateDashAlertas')]
    public function updateInfo($filters){
        $this->ini = $filters['ini'];
        $this->fin = $filters['fin'];
        $this->cds = $filters['cds'];
    }

    public function getInfo(){
        $this->tiempo = [];
        $data = [];
        $labels = [];

        foreach($this->cds as $cd):
            if($cd['visible']):
                $resultado = $this->getTime($cd['CD'], $this->ini, $this->fin)[0];
                $this->tiempo[] = $resultado;
                $labels[] = $cd['CD'];
                $data[] = $this->toSecond($resultado->resultado);
            endif;
        endforeach;

        $this->dispatch('updateTableTimeLost', ["labels" => $labels, "data" => $data]);
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.alertas-t-m-a.tiempo-perdido');
    }
}
