<?php

namespace App\Livewire\Dashboard;

use App\Enums\CDS;
use App\Traits\GetCurrentTMATable;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;

class Home extends Component
{
    use GetCurrentTMATable;

    #[Title('Pantalla de inicio')]

    public $cds = [];
    public $tabla = [];

    public function mount(){
        foreach(CDS::cases() as $c):
            array_push($this->cds, Array("CD" => $c->value, "visible" => true));
        endforeach;
    }

    #[On('updateDashHome')]
    public function updateInfo($filters){
        $this->cds = $filters['cds'];
    }

    public function getInfo(){
        $this->tabla = Array();

        foreach($this->cds as $cd):
            foreach($this->getTMATableByCD($cd['CD']) as $line):
                $this->tabla[] = $line;
            endforeach;
        endforeach;

        $this->dispatch("updateHomeData", $this->tabla);
    }

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
