<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use App\Models\Usuario;
use Livewire\Component;

class UsuarioDelete extends Component
{

     public $usuarioId;
    public $nome;

    public function mount($id)
    {
        $admin = Usuario::find($id);
        if ($admin == null) {
            session()->flash('error', 'Usuario não não existente ou não encontrado');
            return redirect()->route('admins.index');
        } else {
        $admin = Usuario::find($id);
        $this->usuarioId = $id;
        $this->nome = $admin->nome;
        }
    }

    public function delete()
    {
        $usuario = Usuario::find($this->usuarioId);
        $user = User::find($usuario->user_id);
 
        $usuario->delete();
 
        if ($user) {
            $user->delete();
        }
 
        session()->flash('message', 'Usuario deletado com sucesso.');
        return redirect()->route('usuarios.index');
    }

    public function render()
    {
        return view('livewire.usuario.usuario-delete');
    }
}
