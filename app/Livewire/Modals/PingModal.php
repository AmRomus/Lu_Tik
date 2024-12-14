<?php

namespace App\Livewire\Modals;

use App\Models\InetDevices;
use Livewire\Attributes\On;
use Livewire\Component;

class PingModal extends Component
{
    public $show;
    public $netdev;
    public $ping_array;
    #[On('show_modal')]
    public function show_modal($device_id=null)
    {      
      $this->show=!$this->show;      
      $this->netdev=InetDevices::find($device_id);
      
    }
    public function render()
    {
        return view('livewire.modals.ping-modal');
    }
    public function ping_dev()
    {
        $this->ping_array=null;
        if($this->netdev){
            $this->ping_array= $this->netdev->ping;
           }
    }
}
