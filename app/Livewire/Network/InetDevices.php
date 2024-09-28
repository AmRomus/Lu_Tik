<?php

namespace App\Livewire\Network;

use Livewire\Component;

class InetDevices extends Component
{
    public function render()
    {
        return view('livewire.network.inet-devices',['devices'=>\App\Models\InetDevices::all()]);
    }
}
