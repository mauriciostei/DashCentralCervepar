<?php

namespace App\Livewire\Dashboard\HomeTMA;

use App\Models\CurrentData;
use App\Traits\AddTimeIntervals;
use Livewire\Component;
use Livewire\Attributes\On;

class TableMovil extends Component
{
    use AddTimeIntervals;

    public $tabla;
    public $tiempo_perdido;

    public $centros = [];
    public $moviles = [];
    // public $operadoras = [];
    public $sitios = [];

    public $column = 'centro';
    public $orden = 'asc';

    public function getInfo(){
        $this->tabla = CurrentData::
            whereIn('centro', $this->centros)
            ->whereIn('movil', $this->moviles)
            // ->whereIn('operador', $this->operadoras)
            ->whereIn('punto', $this->sitios)
            ->orderBy($this->column, $this->orden)
            ->get()
        ;
        $perdida = 0;
        $this->tiempo_perdido = '';

        foreach($this->tabla as $tab):
            $perdida += $this->toSecond($tab['tiempo_perdido']);
        endforeach;

        $this->tiempo_perdido = $this->toInterval($perdida);
    }

    #[On('updateTableOrder')]
    public function updateOrder($filters){
        $this->column = $filters['column'];
        $this->orden = $filters['order'];
    }

    #[On('updateFiltercentro')]
    public function updateCentros($filters){
        $this->centros = $filters;
    }

    #[On('updateFiltermovil')]
    public function updateMoviles($filters){
        $this->moviles = $filters;
    }

    // #[On('updateFilteroperador')]
    // public function updateOperadoras($filters){
    //     $this->operadoras = $filters;
    // }

    #[On('updateFilterpunto')]
    public function updatePuntos($filters){
        $this->sitios = $filters;
    }

    public function render()
    {
        $this->getInfo();
        return view('livewire.dashboard.home-t-m-a.table-movil');
    }
}
