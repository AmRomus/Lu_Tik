<?php

namespace App\Livewire\Modals;

use App\Models\PlayList;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewPlayList extends Component
{
    public $show;
    #[Rule('required|unique:play_lists,name')]
    public $name;
    public function render()
    {
        return view('livewire.modals.new-play-list');
    }
    #[On('show_modal')]
    public function show_modal()
    {      
      $this->show=!$this->show;       
    }
    public function save()
    {
        $this->validate();
        $p=new PlayList;
        $p->name=$this->name;
        $p->save();
        $this->dispatch('saved');
        $this->show_modal();
    }
}
