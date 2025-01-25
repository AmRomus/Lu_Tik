<?php

namespace App\Livewire\Modals;

use App\Models\SupportTicket;
use Livewire\Attributes\On;
use Livewire\Component;

class OldTicket extends Component
{
    public $show;
    public $history=[];
    public $billing_account;
    public $ticket_list=true;
    public $ticket;
    #[On('show_modal')]
    public function show_modal()
    {
        $this->show=true;
        $this->history=SupportTicket::whereBillingAccountId($this->billing_account)->get();
    }
    #[On('hide_modal')]
    public function hide_modal()
    {
        $this->show=false;
    }

    public function mount ($account)
    {
        $this->billing_account=$account;
    }
    public function render()
    {
        return view('livewire.modals.old-ticket');
    }
    public function show_ticket($tid)
    {
        $this->ticket=SupportTicket::find($tid);
        $this->ticket_list=false;
    }
    public function to_list()
    {
        $this->ticket_list=true;
        $this->ticket=null;
    }

}
