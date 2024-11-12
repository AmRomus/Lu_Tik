<?php

namespace App\Livewire\Pon;

use App\Models\Olt;
use Livewire\Component;

class OltList extends Component
{
    public function render()
    {
        return view('livewire.pon.olt-list',['olts'=>Olt::all()]);
    }
}