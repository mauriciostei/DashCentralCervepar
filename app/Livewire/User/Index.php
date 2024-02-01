<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    #[Title('Usuarios del sistema')]

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function render()
    {
        return view('livewire.user.index', [
            'users' => User::where('name', 'like', "%$this->search%")->orWhere('email', 'like', "%$this->search%")->orderBy('id', 'asc')->paginate(10),
        ]);
    }
}
