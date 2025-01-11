<?php

namespace App\Livewire\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class ShortHistory extends Component
{
    public $show;
    public $history=[];
    #[On('show_modal')]
    public function show_history($obj,$id)
    {
        $this->show=true;
        $my_obj=("\\App\\Models\\".$obj)::find($id);
        $this->history=$my_obj->AcctionsHistory;
        
    }
    public function render()
    {
        return view('livewire.modals.short-history');
    }
    #[On('hide_history')]
    public function hide_history()
    {
        $this->show=false;
    }
}
