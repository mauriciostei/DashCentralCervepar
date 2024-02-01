<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;

class Create extends Component
{
    #[Title('Crear Usuario')]

    #[Validate('required|string|min:5|unique:users,name', as: 'nombre del usuario')]
    public $name;

    #[Validate('required|email|unique:users,email', as: 'correo electrónico')]
    public $email;

    #[Validate('required|string|min:5', as: 'contraseña del usuario')]
    public $password;

    #[Validate('required|integer', as: 'tipo de usuario')]
    public $level = 100;

    public function save(){
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = bcrypt($this->password);
        $user->level = $this->level;
        $user->save();
        
        session()->flash('toast', 'Usuario creado con éxito!');
        redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
