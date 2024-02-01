<?php

namespace App\Livewire\Dashboard\HomeTMA;

use App\Traits\AddTimeIntervals;
use App\Traits\GetCurrentTMATable;
use Livewire\Component;
use Livewire\Attributes\On;

class TableMovil extends Component
{
    use GetCurrentTMATable;
    use AddTimeIntervals;

    public $cds;
    public $tabla;
    public $tiempo_perdido;

    public $moviles = [];
    public $puntos = [];
    public $operadoras = [];

    public $column = 'centro';
    public $orden = 1;

    #[On('updateDashHome')]
    public function updateInfo($filters){
        $this->cds = $filters['cds'];
        $this->getInfo();
    }

    #[On('updateTableOrder')]
    public function updateOrder($filters){
        $this->column = $filters['column'];
        $this->orden = $filters['order'];
        $this->getInfo();
    }

    #[On('updateFiltermoviles')]
    public function updateMoviles($filters){
        $this->moviles = $filters['tabla'];
    }

    #[On('updateFilterpuntos')]
    public function updatePuntos($filters){
        $this->puntos = $filters['tabla'];
    }

    #[On('updateFilteroperadoras')]
    public function updateOperadoras($filters){
        $this->operadoras = $filters['tabla'];
    }

    public function mount($cds){
        $this->cds = $cds;
        $this->getInfo();

        foreach($this->tabla as $tab):
            if(!in_array($tab->movil, $this->moviles)): $this->moviles[] = $tab->movil; endif;
            if(!in_array($tab->punto, $this->puntos)): $this->puntos[] = $tab->punto; endif;
            if(!in_array($tab->operador, $this->operadoras)): $this->operadoras[] = $tab->operador; endif;
        endforeach;
    }

    public function getInfo(){
        $perdida = 0;
        $this->tabla = Array();
        $this->tiempo_perdido = '';

        foreach($this->cds as $cd):
            foreach($this->getTMATableByCD($cd['CD']) as $line):
                $this->tabla[] = $line;
                $perdida += $this->toSecond($line->tiempo_perdido);
            endforeach;
        endforeach;

        $temp = array_column($this->tabla, $this->column);
        array_multisort($temp, $this->orden == 1 ? SORT_ASC : SORT_DESC, $this->tabla);

        $this->tiempo_perdido = $this->toInterval($perdida);
    }

    public function render()
    {
        return view('livewire.dashboard.home-t-m-a.table-movil');
    }
}
