<?php

namespace App\Livewire\Dashboard;

use App\Traits\GetCurrentTMATable;
use Livewire\Component;
use Livewire\Attributes\Title;

class Home extends Component
{
    use GetCurrentTMATable;

    #[Title('Pantalla de inicio')]

    public function render()
    {
        return view('livewire.dashboard.home');
    }
}
