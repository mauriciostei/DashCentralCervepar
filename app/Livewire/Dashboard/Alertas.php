<?php

namespace App\Livewire\Dashboard;

use App\Enums\CDS;
use Livewire\Component;
use Livewire\Attributes\Title;

class Alertas extends Component
{
    #[Title('Alertas TMA')]

    public $cds = [];

    public $ini;
    public $fin;

    public function mount(){
        $this->ini = date('Y-m-d', strtotime(now()));
        $this->fin = date('Y-m-d', strtotime(now()));

        foreach(CDS::cases() as $c):
            array_push($this->cds, Array("CD" => $c->value, "visible" => true));
        endforeach;
    }

    public function send(){
        $this->dispatch('updateDashAlertas', [
            "ini" => $this->ini,
            "fin" => $this->fin,
            "cds" => $this->cds,
        ]);
    }

    public function updated(){
        $this->send();
    }

    public function render()
    {
        return view('livewire.dashboard.alertas');
    }
}
