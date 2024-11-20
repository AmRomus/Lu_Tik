<?php

namespace App\Livewire\Pon;

use App\Models\OltIfaces;
use Livewire\Attributes\On;
use Livewire\Component;

class OnuList extends Component
{
    public $pon;
    #[On('show_pon')]
    public function show_pon(OltIfaces $pon)
    {
        $this->pon = null;
        $this->pon=$pon;
    }
    public function render()
    {
        return view('livewire.pon.onu-list');
    }
}
