<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UsuarioEdit extends Component
{
    public $usuarioId;
    public $userId;
    public $nome;
    public $email;
    public $password;


    public function rules()
    {
        return [
        'nome' => 'required|string|min:3|max:100',
        'email' => 'required|email|unique:users,email,' . $this->userId,
        'password' => 'required|min:6',
        ];
    }

    protected $messages = [
      'nome.required' => 'O Campo Nome é Obrigatório',
        'nome.string' => 'O Campo Nome Deve Ser Um Texto do Tipo Válido',
        'nome.min' => 'O Campo Nome Deve Ter no Mínimo 3 caracteres',
        'nome.max' => 'O campo NOme Deve Ter no Máximo 100 caracteres',

        'email.required' => 'O Campo Email é Obrigatório',
        'email.email' => 'O Campo Email Deve Estar No Formato do Tipo Email',
        'email.unique' =>  'Email Já Cadastrado',

        'password' => 'O Campo Senha é Obrigatório',
        'password' => ' O Campo Senha Deve Ter no Mínimo 6 Caracteres'
    ];

    public function mount($id){
        $usuario = Usuario::find($id);
        if($usuario == null){
            session()->flash('error', 'Usuario Não Existente ou Não Encontrado');
           // return redirect()->route('usuario.index');
        } else {
            $this->usuarioId = $usuario->id;
            $this->nome = $usuario->nome;
            $this->email = $usuario->user->email;
            $this->password = $usuario->user->password;
            $this->userId = $usuario->user->id;
        }
    }

    public function update(){
        $this->validate();

        $usuario = Usuario::find($this->usuarioId);
        $user = User::find($usuario->id);


         $usuario->update([
            'nome' => $this->nome,
        ]);

        $user->update([
            'email' => $this->email,
            'password' => $this->password
        ]);

        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->save();

        session()->flash('message', 'Admin atualizado com sucesso!');
        return redirect()->route('usuarios.index');
    }


    public function render()
    {
        return view('livewire.usuario.usuario-edit');
    }
}
