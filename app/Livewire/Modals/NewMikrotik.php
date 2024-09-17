<?php

namespace App\Livewire\Modals;

use App\Models\Mikrotik;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use \RouterOS\Client;
use Exception;

class NewMikrotik extends Component
{
    public $show;
    #[On('show_modal')]
    public function show_modal()
    {      
        $this->show=!$this->show;
    }

    public $name;
    #[Validate('required|unique:mikrotiks,hostname')]
    public $hostname;
    public $login;
    public $password;
    public $port=8728;
    public $ssl;
   
    public function save()
    {
        
        $this->validate();
        $serv = new Mikrotik();
        $serv->name=$this->name;
        $serv->hostname=$this->hostname;
        $serv->login=$this->login;
        $serv->password=$this->password;
        $serv->port=intval($this->port);
        if(!isset($this->ssl)||!$this->ssl)
            $serv->ssl=0;
        else
            $serv->ssl=1;
        try {
        $client = new Client([
            'host' => $this->hostname,
            'user' => $this->login,
            'pass' => $this->password,
            'port' => $this->port,
        ]);
        $serv->save();
        $this->dispatch('saved');
        $this->show_modal();
        $this->reset();
        } catch (Exception $ex)
        {
            $this->addError('login',$ex->getMessage());
        }

        //$serv->save();
      
    }
    public function render()
    {
        return view('livewire.modals.new-mikrotik');
    }
}
