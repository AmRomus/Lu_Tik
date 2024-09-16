<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Title;
use Livewire\Component;
use Auth;
class Login extends Component
{
    public $email;
    public $password;
    
    #[Title('LuTik Login')]
    public function render()
    {
        return view('livewire.auth.login');
    }
    public function doLogin()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];
        
        if (Auth::attempt($credentials)) {
            // Authentication was successful
            return redirect()->intended('/');
        } else {
            // Authentication failed
            $this->addError('email', 'Invalid email or password.');
        }
    }
}
