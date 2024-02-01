<?php

namespace App\Livewire\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;

class LoginForm extends Component
{
    #[Title('Ingresar al sistema')]

    #[Validate('required|email|exists:users,email', as: 'correo electrónico')]
    public $email;

    #[Validate('required|string', as: 'contraseña del usuario')]
    public $password;

    public function ingresar(){
        $this->validate();

        if(Auth::attempt(Array('email' => $this->email, 'password' => $this->password))){
            session()->regenerate();
            session()->flash('toast', 'Bienvenido al sistema');
            $this->redirectRoute('home');
        }

        return $this->addError('error', 'Usuario o contraseña inválidos');
    }

    public function render()
    {
        return view('livewire.user.login-form');
    }
}
