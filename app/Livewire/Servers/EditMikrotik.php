<?php

namespace App\Livewire\Servers;

use App\Models\ControlInterface;
use App\Models\Mikrotik;

use Livewire\Attributes\On;
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
    public $uncontroled;
    public function mount(Mikrotik $mikrotik)
    {
        $this->mikrotik=$mikrotik;
        $this->name=$mikrotik->name;
        $this->hostname=$mikrotik->hostname;
        $this->login = $mikrotik->login;
        $this->password = $mikrotik->password;
        $this->port = $mikrotik->port;
        $this->ssl=$mikrotik->ssl;
        $controled_ids=$mikrotik->ControlInterface->pluck('ident')->toArray();
        $uncontroled=$this->mikrotik->RemoteInterfaces;
        foreach($uncontroled as $key=>$item){          
            if(in_array($item['.id'],$controled_ids,true)){
                unset($uncontroled[$key]);
            }
        }
        $this->uncontroled=$uncontroled;
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
    #[On('changed')]
    public function refresh(){}
    public function add_iface($key)
    {
        // dd($this->uncontroled[$key]);
        $new_control = new ControlInterface(["ident"=>$this->uncontroled[$key]['.id'],'interface'=>$this->uncontroled[$key]['name']]);
        $this->mikrotik->ControlInterface()->save($new_control);
        return redirect(request()->header('Referer'));
    }
}
