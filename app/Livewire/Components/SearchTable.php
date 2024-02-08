<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\On;

class SearchTable extends Component
{
    public $tabla;
    public $lista = [];
    public $search;

    public function mount($tabla){
        $this->tabla = $tabla;
    }

    #[On('updateHomeData')]
    public function updateData($data){
        $newColumn = array_unique(array_column($data, $this->tabla));
        $myColumn = array_unique(array_column($this->lista, 'nombre'));
        foreach($newColumn as $line):
            if(!in_array($line, $myColumn)){
                $line = Array('nombre' => $line, 'visible' => true);
                $this->lista[] = $line;
            }
        endforeach;
        $this->updated();
    }

    public function changeAll($status){
        foreach($this->lista as $key => $lis):
            $this->lista[$key]['visible'] = $status;
        endforeach;
        $this->updated();
    }

    public function updated(){
        $lista = array_filter($this->lista, function($var){
            return $var['visible'];
        });
        $lista = array_column($lista, 'nombre');
        $this->dispatch("updateFilter$this->tabla", ['tabla' => $lista]);
    }

    public function render()
    {
        return view('livewire.components.search-table');
    }
}
