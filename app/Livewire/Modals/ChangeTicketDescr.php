<?php

namespace App\Livewire\Modals;

use App\Models\AcctionsHistory;
use App\Models\SupportTicket;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ChangeTicketDescr extends Component
{
    public $show;
    #[Rule('required')]
    public $description;
    public $ticket;
    public $account;
    #[On('show_modal')]
    public function show_modal($tid)
    {
        $this->ticket=SupportTicket::find($tid);
        if($this->ticket){
            $this->show=!$this->show;
            $this->description=$this->ticket->description;
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
            $this->ticket->description=$this->description;
            $this->ticket->save();
            $acct= new AcctionsHistory();
            $acct->user_id=Auth::user()->id;
            $acct->acction="Change Description";
            $acct->meta="New Connaction ticket #".$this->ticket->id;
            $this->ticket->AcctionsHistory()->save($acct); 
            $this->dispatch('saved');            
        }
        $this->hide_modal();
    }

    public function render()
    {
        return view('livewire.modals.change-ticket-descr');
    }
}
