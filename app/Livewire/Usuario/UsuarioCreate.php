<?php

namespace App\Livewire\Usuario;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UsuarioCreate extends Component
{

    public $nome;
    public $email;
    public $password;

    protected $rules = [
        'nome' => 'required|string|min:3|max:100',
        'email' => 'required|email|unique:users,email|',
        'password' => 'required|min:6',
    ];

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


    public function store()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'user_type' => 'admin',
        ]);


        Usuario::create([
            'user_id' => $user->id,
            'nome' => $this->nome,
        ]);

        session()->flash('message', 'Usuario cadastrado com sucesso');
        $this->reset('nome', 'email', 'password');
    }


    public function render()
    {
        return view('livewire.usuario.usuario-create');
    }
}
