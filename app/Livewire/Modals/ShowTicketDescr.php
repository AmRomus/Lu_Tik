<?php

namespace App\Livewire\Modals;

use App\Models\SupportTicket;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowTicketDescr extends Component
{
    public $show;
    public $item;
    #[On('show_modal')]
    public function show_modal($tid)
    {
        $this->show=true;       
        $this->item=SupportTicket::find($tid);
    }
    public function render()
    {
        return view('livewire.modals.show-ticket-descr');
    }
    #[On('hide_modal')]
    public function hide_modal()
    {
        $this->show=false;
        $this->item=null;
    }
}
