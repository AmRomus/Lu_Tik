<?php

namespace App\Livewire\Servers;

use App\Models\Mikrotik;
use Livewire\Component;

class ControlledInterfaces extends Component
{
    public $mk;
    public function mount(Mikrotik $mikrotik){
      $this->mk = $mikrotik;
    }
    public function render()
    {
        $ControlInterface=$this->mk->ControlInterface;
        return view('livewire.servers.controlled-interfaces',compact('ControlInterface'));
    }
}
