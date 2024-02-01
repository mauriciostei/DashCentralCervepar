<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Orden extends Component
{
    public $columna;
    public $direccion;

    public function changeOrder($direccion){
        $this->direccion = $direccion;
        $this->dispatch('updateTableOrder', ['column' => $this->columna, 'order' => $this->direccion]);
    }

    public function render()
    {
        return view('livewire.components.orden');
    }
}
