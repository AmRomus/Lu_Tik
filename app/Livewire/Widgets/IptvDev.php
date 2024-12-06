<?php

namespace App\Livewire\Widgets;

use App\Models\IptvDevice;
use Livewire\Component;

class IptvDev extends Component
{
    public $item;
    public function render()
    {
        return view('livewire.widgets.iptv-dev');
    }
    public function mount( $dev){
        $this->item = IptvDevice::find($dev);           
    }
}
