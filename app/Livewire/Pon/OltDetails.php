<?php

namespace App\Livewire\Pon;

use App\Models\Olt;
use Livewire\Component;

class OltDetails extends Component
{
    public $olt;
    public function mount(Olt $olt)
    {
        $this->olt=$olt;
    }
    public function render()
    {
       
        return view('livewire.pon.olt-details');
    }
}
