<?php

namespace App\Livewire\Modals;

use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewTarif extends Component
{    
    public $show;
    #[Rule('required|unique:tarifs,name')]
    public $name;
    public $description;
   
    #[On('show_modal')]
    public function show_modal()
    {      
      $this->show=!$this->show;      
      
    }
    public function save()
    {
        $this->validate();
        Tarif::create(['name'=>$this->name,'description'=>$this->description]);
        $this->show_modal();
        $this->dispatch('saved');
    }

    public function render()
    {
        return view('livewire.modals.new-tarif');
    }
}
