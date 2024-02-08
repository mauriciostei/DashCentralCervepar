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

    #[On('updateHomeData')]
    public function updateData($data){
        $this->tabla = $data;
        $perdida = 0;
        $this->tiempo_perdido = '';

        foreach($this->tabla as $tab):
            $perdida += $this->toSecond($tab['tiempo_perdido']);
        endforeach;

        $temp = array_column($this->tabla, $this->column);
        array_multisort($temp, $this->orden == 1 ? SORT_ASC : SORT_DESC, $this->tabla);

        $this->tiempo_perdido = $this->toInterval($perdida);
    }

    #[On('updateDashHome')]
    public function updateInfo($filters){
        $this->cds = $filters['cds'];
    }

    #[On('updateTableOrder')]
    public function updateOrder($filters){
        $this->column = $filters['column'];
        $this->orden = $filters['order'];
    }

    #[On('updateFiltermovil')]
    public function updateMoviles($filters){
        $this->moviles = $filters['tabla'];
    }

    #[On('updateFilterpunto')]
    public function updatePuntos($filters){
        $this->puntos = $filters['tabla'];
    }

    #[On('updateFilteroperador')]
    public function updateOperadoras($filters){
        $this->operadoras = $filters['tabla'];
    }

    public function mount($cds, $tabla){
        $this->cds = $cds;
        $this->tabla = $tabla;
    }

    public function render()
    {
        return view('livewire.dashboard.home-t-m-a.table-movil');
    }
}
