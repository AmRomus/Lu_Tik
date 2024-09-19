<?php

namespace App\Livewire\Misc;

use App\Models\Address;
use Livewire\Attributes\On;
use Livewire\Component;

class Addressbook extends Component
{
    public $selected;
    public $sid;
    public function render()
    {
        
        return view('livewire.misc.addressbook',["addr"=>Address::isRoot()->get()]);
    }
    #[On('select_address')]
    public function select_address($id)
    {
        $this->selected=Address::find($id)?->rootAncestororSelf()->first();
        $this->sid=Address::find($id);
    }
 
    public function delete()
    {
        $parent=$this->sid->parent;       
        $this->sid->delete();
        $this->dispatch('saved',c_id: $parent->id);
    }
}
