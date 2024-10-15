<?php

namespace App\Livewire\Finances;

use App\Models\Tarif;
use Livewire\Component;
use Livewire\Attributes\On;

class Tarifs extends Component
{
    public $service="Service";
    public $tarif_list;
    public function render()
    {
        $this->tarif_list=Tarif::all();
        return view('livewire.finances.tarifs');
    }
}
