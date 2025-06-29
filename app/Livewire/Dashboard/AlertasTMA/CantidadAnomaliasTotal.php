<?php

namespace App\Livewire\Dashboard\AlertasTMA;

use App\Traits\GetCantidadAnomalias;
use Livewire\Component;
use Livewire\Attributes\On;

class CantidadAnomaliasTotal extends Component
{
    use GetCantidadAnomalias;

    public $anomalias;

    public $ini;
    public $fin;
    public $cds;

    public $subTotal = 0;
    public $subTotalPendiente = 0;

    #[On('updateDashAlertas')]
    public function updateInfo($filters){
        $this->ini = $filters['ini'];
        $this->fin = $filters['fin'];
        $this->cds = $filters['cds'];
    }

    public function getInfo(){
        $this->anomalias = [];

        foreach($this->cds as $cds):
            if($cds['visible']):
                $resultado = $this->getAnomalias($cds['CD'], $this->ini, $this->fin);
                if (!empty($resultado)) {
                    $this->anomalias[] = $resultado[0];
                }
            endif;
        endforeach;

        $total = Array();
        $enCurso = Array();
        $labels = Array();

        $this->subTotal = 0;
        $this->subTotalPendiente = 0;

        foreach($this->anomalias as $anom):
            $labels[] = $anom->centro;
            $total[] = $anom->total;
            $enCurso[] = $anom->total - $anom->tratadas;

            $this->subTotal += $anom->total;
            $this->subTotalPendiente += ($anom->total - $anom->tratadas);
        endforeach;

        $this->dispatch('cantidadAnomalias', ['labels' => $labels, 'data' => $total, 'subTotal' => $this->subTotal]);
        $this->dispatch('cantidadAnomaliasPendientes', ['labels' => $labels, 'data' => $enCurso, 'subTotal' => $this->subTotalPendiente]);
    }


    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.alertas-t-m-a.cantidad-anomalias-total');
    }
}
