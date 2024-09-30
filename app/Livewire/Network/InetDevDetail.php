<?php

namespace App\Livewire\Network;

use App\Models\InetDevices;
use Livewire\Component;

class InetDevDetail extends Component
{
    public $dev;
    public $interface;
    public $mk;
    public $ip;
    public $mac;
    public $bind;
    public function mount(InetDevices $dev){
        $this->dev = $dev;        
        $this->interface=$dev->ControlInterface->interface;
        $this->mk=$dev->ControlInterface->Mikrotik->name;
        $this->ip=$dev->ip;
        $this->mac=$dev->mac;
        $this->bind=$dev->bind;
    }
    public function render()
    {
        return view('livewire.network.inet-dev-detail');
    }
}
