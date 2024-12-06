<?php

namespace App\Livewire\Widgets;

use App\Models\InetDevices;
use App\Models\Mikrotik;
use Livewire\Component;

class NetDev extends Component
{
    public $dev;
    public $online=false;
    public $wrong=false;
    public function mount( $dev){
        $this->dev = InetDevices::find($dev);        
        // if($this->dev->bind==1){        
        $interface=($this->dev->ControlInterface?->interface)? $this->dev->ControlInterface->interface:"-";
        $mk= $this->dev->ControlInterface?->Mikrotik;
        // $this->ip= $this->dev->ip;        
        $this->ret=$this->dev->ControlInterface?->Mikrotik->findDevice($this->dev->mac)->toArray();
        if($this->ret){
            foreach($this->ret as $item){
                if($item->mk->id==$mk->id&&$interface==$item->interface && $this->dev?->ip==$item->address && $item->complete=="true")
                  {
                    $this->online=true;
                    $this->wrong=false;
                    break;
                  }
                else{                   
                    $this->wrong=true;
                }
            }
        }
        // }else 
        // {
        //     foreach(Mikrotik::all() as $mk){
        //         $this->ret=$mk->findDevice( $this->dev->mac)->toArray();

        //     }
        // }
        // $this->mac= $this->dev->mac;
        // $this->bind= $this->dev->bind;

    }
    public function render()
    {
        return view('livewire.widgets.net-dev');
    }
}
