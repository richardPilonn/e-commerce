<?php

namespace App\Livewire\Usuario;

use App\Models\Usuario;
use Livewire\Component;
use Livewire\WithPagination;

class UsuarioIndex extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10; 

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
    ];


    public function render()
    {
        $usuarios = Usuario::where('nome', 'like', "%{$this->search}%")
        ->paginate($this->perPage);

        return view('livewire.usuario.usuario-index', compact('usuarios'));
    }
}
