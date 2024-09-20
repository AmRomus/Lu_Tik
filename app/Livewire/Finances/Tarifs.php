<?php

namespace App\Livewire\Finances;

use App\Models\Tarif;
use Livewire\Component;

class Tarifs extends Component
{
    public $service="Service";
    public function render()
    {
        return view('livewire.finances.tarifs',['tarifs'=>Tarif::all()]);
    }
    
}
