<?php

namespace App\Livewire\Modals;

use App\Models\AcctionsHistory;
use App\Models\BillingAccount;
use App\Models\SupportTicket;
use App\TicketTypes;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewTicket extends Component
{
    public $show;
    #[Rule('required')]
    public $description;
    #[Rule('required')]
    public $taskdate;
    public $ticket;
    public $account;
    public $ticket_type=1;
    public $alter_phone;
    #[On('show_modal')]
    public function show_modal()
    {
        $this->show=!$this->show;      
    }
    public function hide_modal()
    {
        $this->show=false;
    }
    public function mount ($account)
    {
       $this->account=BillingAccount::find($account);
    }
    public function save()
    {
      //  dd($this->ticket_type);
        $this->validate();
        $st=new SupportTicket();
        $st->description=$this->description;
        $st->ticket_type=$this->ticket_type;
        $st->planed_time=$this->taskdate;
        $st->alter_phone=$this->alter_phone;
        $st->user_id=Auth::user()->id;
        $this->account->SupportTicket()->save($st);
        $st->refresh();
        $acct= new AcctionsHistory();
        $acct->user_id=Auth::user()->id;
        $acct->acction="Create";
        $acct->meta="New connection ticket #".$st->id;
        $st->AcctionsHistory()->save($acct);
        $this->hide_modal();
        $this->dispatch('saved');
    }
    public function render()
    {
        $ttypes=TicketTypes::values();
        return view('livewire.modals.new-ticket',compact('ttypes'));
    }
}
