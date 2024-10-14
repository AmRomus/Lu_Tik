<?php

namespace App\Livewire\Network;

use App\Models\InetDevices;
use App\Models\Mikrotik;
use Livewire\Attributes\On;
use Livewire\Component;

class InetDevDetail extends Component
{
    public $dev;
    public $interface;
    public $mk;
    public $ip;
    public $mac;
    public $bind;
    public $ret=[];
    public function mount( $dev){
        $this->dev = InetDevices::find($dev); 
        //$this->dev = $dev;
        if($this->dev->bind==1){        
        $this->interface=($this->dev->ControlInterface?->interface)? $this->dev->ControlInterface->interface:"-";
        $this->mk= $this->dev->ControlInterface->Mikrotik->name;
        $this->ip= $this->dev->ip;
        $this->ret=$this->dev->ControlInterface->Mikrotik->findDevice( $this->dev->mac);
        }else 
        {
            foreach(Mikrotik::all() as $mk){
                $this->ret=$mk->findDevice( $this->dev->mac);
                $this->mk=$mk->name;
              // dd($ret);
               break;
            }
        }
        $this->mac= $this->dev->mac;
        $this->bind= $this->dev->bind;
    }
    public function render()
    {
        return view('livewire.network.inet-dev-detail');
    }

}