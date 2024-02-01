<?php

namespace App\Livewire\Components;

use App\Enums\CDS;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Search extends Component
{
    public $tabla;
    public $lista = [];
    public $search;

    public function mount($tabla){
        $this->tabla = $tabla;
        foreach(CDS::cases() as $cd):
            $data = DB::connection($cd->value)->select("select * from $this->tabla");
            foreach($data as $dat):
                $linea = Array('nombre' => $dat->nombre, 'visible' => true);
                if(!in_array($linea, $this->lista)): $this->lista[] = $linea; endif;
            endforeach;
        endforeach;
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
        return view('livewire.components.search');
    }
}
