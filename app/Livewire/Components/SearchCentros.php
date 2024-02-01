<?php

namespace App\Livewire\Components;

use App\Enums\CDS;
use Livewire\Component;

class SearchCentros extends Component
{
    public $lista = [];
    public $search;

    public function mount(){
        foreach(CDS::cases() as $c):
            array_push($this->lista, Array("CD" => $c->value, "visible" => true));
        endforeach;
    }

    public function changeAll($status){
        foreach($this->lista as $key => $lis):
            $this->lista[$key]['visible'] = $status;
        endforeach;
        $this->updated();
    }

    public function send(){
        $lista = array_filter($this->lista, function($var){
            return $var['visible'];
        });
        $this->dispatch("updateDashHome", ['cds' => $lista]);
    }

    public function updated(){
        $this->send();
    }

    public function render()
    {
        return view('livewire.components.search-centros');
    }
}
