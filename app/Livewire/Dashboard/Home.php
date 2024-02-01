<?php

namespace App\Livewire\Dashboard;

use App\Enums\CDS;
use Livewire\Component;
use Livewire\Attributes\Title;

class Home extends Component
{
    #[Title('Pantalla de inicio')]

    public $cds = [];

    public function mount(){
        foreach(CDS::cases() as $c):
            array_push($this->cds, Array("CD" => $c->value, "visible" => true));
        endforeach;
    }

    // public function send(){
    //     $lista = array_filter($this->cds, function($var){
    //         return $var['visible'];
    //     });
    //     $this->dispatch('updateDashHome', [
    //         "cds" => $lista,
    //     ]);
    // }

    // public function updated(){
    //     $this->send();
    // }

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
