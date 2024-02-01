<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    #[Title('Editar Usuario')]

    public $user;

    public $name;
    public $email;
    public $level;
    public $active;

    public $changePassword = false;
    public $newPass;
    public $newPassRetry;

    public function rules(){
        return [
            'name' => 'required|string|min:5|unique:users,name,'.$this->user->id,
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'level' => 'required|integer',
            'active' => 'required|boolean',
            'changePassword' => 'required|boolean',
            'newPass' => 'exclude_unless:changePassword,true|string|min:5|same:newPassRetry',
            'newPassRetry' => 'exclude_unless:changePassword,true|string|min:5|same:newPass',
        ];
    }

    public function mount(User $user){
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->level = $user->level->value;
        $this->active = $user->active;
    }

    public function save(){
        $this->validate();

        $this->user->email = $this->email;
        $this->user->name = $this->name;
        $this->user->level = $this->level;
        $this->user->active = $this->active;
        
        if($this->changePassword)
            $this->user->password = bcrypt($this->newPass);

        $this->user->save();

        session()->flash('toast', 'Usuario actualizado con éxito!');
        redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
