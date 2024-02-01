<?php

namespace App\Livewire\Components;

use Livewire\Component;

class OffCanvas extends Component
{
    public $tabla;
    public $titulo;
    public $columna;

    public function render()
    {
        return view('livewire.components.off-canvas');
    }
}
