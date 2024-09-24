<?php

namespace App\Livewire\Modals;

use App\Models\MikroBillApi;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewMikroBill extends Component
{
    public $show;
    #[On('show_modal')]
    public function show_modal()
    {      
        $this->show=!$this->show;
    }
    
    public function render()
    {
        return view('livewire.modals.new-mikro-bill');
    }
    #[Rule('required|unique:mikro_bill_apis,name')]
    public $name;
    public $login;
    public $password;
    #[Rule('required')]
    public $host;
    public $key1;
    public $key2;
    public $port;
    public function save()
    {
        $this->validate();
        MikroBillApi::create([
            'name'=>$this->name,
            'host'=>$this->host,
            'login'=>$this->login,
            'password'=>$this->password,
            'key1'=>$this->key1,
            'key2'=>$this->key2,
            'port'=>$this->port
        ]);
        $this->dispatch('saved');
        $this->show_modal();
    }
}
