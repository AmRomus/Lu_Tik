<?php

namespace App\Livewire\Modals;

use App\Models\AcctionsHistory;
use App\Models\SupportTicket;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ChangeTicketDay extends Component
{
    public $show;
    #[Rule('required')]
    public $taskdate;
    public $ticket;
    public $account;
    #[On('show_modal')]
    public function show_modal($tid)
    {
        $this->ticket=SupportTicket::find($tid);
        if($this->ticket){
            $this->taskdate=$this->ticket->planed_time;
            $this->show=!$this->show;          
        }
         
    }
    public function hide_modal()
    {
        $this->show=false;
    }
    public function mount ()
    {
       
    }
    public function save()
    {
        $this->validate();
        if($this->ticket){
            $this->ticket->planed_time=$this->taskdate;
            $this->ticket->save();
            $acct= new AcctionsHistory();
            $acct->user_id=Auth::user()->id;
            $acct->acction="Change date";
            $acct->meta="Change solve date for #".$this->ticket->id." to ".$this->taskdate;
            $this->ticket->AcctionsHistory()->save($acct); 
            $this->dispatch('saved');            
        }
        $this->hide_modal();
    }
    public function render()
    {
        return view('livewire.modals.change-ticket-day');
    }
}
