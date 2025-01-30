<?php

namespace App\Livewire\Finances;

use App\Models\Tarif;
use Livewire\Component;

class EditTarif extends Component
{
    public $tarif;
    public $name;
    public $description;
    public function mount(Tarif $tarif)
    {
        $this->tarif=$tarif;
        $this->name=$tarif->name;
        $this->description=$tarif->description;
    }
    public function render()
    {
        return view('livewire.finances.edit-tarif');
    }
}
