<?php

namespace App\Livewire\Servers;

use App\Models\Mikrotik;
use Livewire\Component;

class Mikrotiks extends Component
{
    public function render()
    {
        return view('livewire.servers.mikrotiks',['mikrotiks'=>Mikrotik::all()]);
    }
}
