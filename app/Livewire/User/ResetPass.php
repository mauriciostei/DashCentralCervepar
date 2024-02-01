<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ResetPass extends Component
{
    public User $user;

    #[Validate('required|string|current_password', as: 'Contraseña Actual')]
    public $pass;

    #[Validate('required|string|min:5', as: 'Nueva Contraseña')]
    public $newPass;

    #[Validate('required|string|same:newPass', as: 'Repetir nueva')]
    public $newPassRetry;

    public function save(){
        $this->validate();

        $this->user->password = bcrypt($this->newPass);
        $this->user->save();

        return $this->redirectRoute('logout');
    }

    public function render()
    {
        return view('livewire.user.reset-pass');
    }
}
