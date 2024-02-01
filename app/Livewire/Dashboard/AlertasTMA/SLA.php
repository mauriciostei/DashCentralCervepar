<?php

namespace App\Livewire\Dashboard\AlertasTMA;

use App\Traits\GetSLA;
use Livewire\Component;
use Livewire\Attributes\On;

class SLA extends Component
{
    use GetSLA;

    public $ini;
    public $fin;
    public $cds;

    public $corresponde;
    public $noCorresponde;

    #[On('updateDashAlertas')]
    public function updateInfo($filters){
        $this->ini = $filters['ini'];
        $this->fin = $filters['fin'];
        $this->cds = $filters['cds'];
    }

    public function getInfo(){
        $this->corresponde = 0;
        $this->noCorresponde = 0;

        foreach($this->cds as $cd):
            if($cd['visible']):
                $resultado = $this->getSLA($cd['CD'], $this->ini, $this->fin)[0];
                $this->corresponde += $resultado->corresponde;
                $this->noCorresponde += $resultado->no_corresponde;
            endif;
        endforeach;

        $this->dispatch('updateSLA', ["labels" => ["Cumple", "No Cumple"], "data" => [$this->corresponde, $this->noCorresponde]]);
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.alertas-t-m-a.s-l-a');
    }
}
