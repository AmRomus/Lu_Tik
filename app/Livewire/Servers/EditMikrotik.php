<?php

namespace App\Livewire\Servers;

use App\Models\Mikrotik;

use Livewire\Attributes\Rule;
use Livewire\Component;

class EditMikrotik extends Component
{
    public $mikrotik;
    public $name;
    #[Rule('required')]
    public $hostname;
    #[Rule('required')]
    public $login;
    public $password;
    public $port;
    public $ssl;
    public function mount(Mikrotik $mikrotik)
    {
        $this->mikrotik=$mikrotik;
        $this->name=$mikrotik->name;
        $this->hostname=$mikrotik->hostname;
        $this->login = $mikrotik->login;
        $this->password = $mikrotik->password;
        $this->port = $mikrotik->port;
        $this->ssl=$mikrotik->ssl;
    }
    public function render()
    {
        return view('livewire.servers.edit-mikrotik');
    }
    public function save()
    {
        $this->validate();
        $mk=[
            'name'=>$this->name,
            'hostname'=>$this->hostname,
            'login'=>$this->login,
            'password'=>$this->password,
            'port'=>$this->port,
            'ssl'=>$this->ssl
        ];
        $this->mikrotik->update($mk);
    }
}
