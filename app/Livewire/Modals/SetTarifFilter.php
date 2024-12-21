<?php

namespace App\Livewire\Modals;

use App\Livewire\Managment\Accounts;
use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Component;

class SetTarifFilter extends Component
{
    public $selectedt;
    public $show;
    #[On('show_modal')]
    public function show_modal($filtred)
    {
        $this->show=!$this->show;
    }
    
    public function mount()
    {
        $keys=Tarif::all()->pluck('id')->toArray();
        $this->selectedt=array_fill_keys($keys,false);
    }
    public function render()
    {
        return view('livewire.modals.set-tarif-filter',['tarifs'=>Tarif::all()]);
    }
    public function set_filter()
    {
        $this->dispatch('set_tarif_filter',$this->selectedt)->to(Accounts::class);
        $this->show=!$this->show;
    }
}
