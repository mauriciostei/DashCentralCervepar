<?php

namespace App\Livewire\Dashboard\AlertasTMA;

use App\Traits\GetParetoMotivos;
use Livewire\Component;
use Livewire\Attributes\On;

class Pareto extends Component
{
    use GetParetoMotivos;

    public $ini;
    public $fin;
    public $cds;

    public $resultado;

    #[On('updateDashAlertas')]
    public function updateInfo($filters){
        $this->ini = $filters['ini'];
        $this->fin = $filters['fin'];
        $this->cds = $filters['cds'];
    }

    public function getInfo(){
        $this->resultado = [];

        foreach($this->cds as $cd):
            if($cd['visible']):
                $respuesta = $this->getPareto($cd['CD'], $this->ini, $this->fin);
                array_push($this->resultado, ...$respuesta);
            endif;
        endforeach;

        $agrupado = [];
        foreach($this->resultado as $res):
            $agrupado[$res->nombre] = array_key_exists($res->nombre, $agrupado) ? $agrupado[$res->nombre] + $res->cantidad : $res->cantidad;
        endforeach;

        arsort($agrupado);
        $this->resultado = $agrupado;

        $labels = [];
        $data = [];

        $total = array_sum($this->resultado);
        $proporcion = [];

        $i = 0;
        foreach($this->resultado as $key => $res):
            $i++;

            $labels[] = $key;
            $data[] = $res;
            $suma = end($proporcion);
            $proporcion[] = (($res / $total) * 100) + $suma; 

            if($i == 5): break; endif;
        endforeach;

        $this->dispatch('updatePareto', ["labels" => $labels, "data" => $data, "proporcion" => $proporcion]);
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.alertas-t-m-a.pareto');
    }
}
