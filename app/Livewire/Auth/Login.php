<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
     public $email; 
    public $password;

    public function login(){
        if(Auth::attempt(['email' => $this->email, 
        'password' => $this->password])){

            session()->regenerate(); 
            return redirect()->route('dashboard'); 
        } 

        session()->flash(['error' => 'credenciais incorretas']); 

    }

    public function render()
    {
        Auth::logout();
        return view('livewire.auth.login');
    }
}