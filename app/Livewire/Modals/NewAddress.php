<?php

namespace App\Livewire\Modals;

use App\Models\Address;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;

class NewAddress extends Component
{
    public $show;
    #[Rule('required')]
    public $unit;
    public $parent;
    public function render()
    {
        return view('livewire.modals.new-address');
    }
    #[On('show_modal')]
    public function show_modal($parent=null)
    {      
      $this->show=!$this->show;      
      if($parent)
      {
        $this->parent=$parent;
      }
    }
    public function save()
    {
        $this->validate();
        $addr=Address::create(['parent_id'=>$this->parent,'unit'=>$this->unit]);
        $this->show_modal();
        $this->dispatch('saved', c_id: $this->parent);
    }

}
