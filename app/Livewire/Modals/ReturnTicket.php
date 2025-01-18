<?php

namespace App\Livewire\Modals;

use App\Models\AcctionsHistory;
use App\Models\SupportTicket;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ReturnTicket extends Component
{
    public $show;
 
    public $description;
    public $ticket;
    public $account;
    #[On('show_modal')]
    public function show_modal($tid)
    {
        $this->ticket=SupportTicket::find($tid);
        if($this->ticket){
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
       
        if($this->ticket){
            $this->ticket->processed=false;
            $this->ticket->save();
            $acct= new AcctionsHistory();
            $acct->user_id=Auth::user()->id;
            $acct->acction="Return ticket";
            $acct->meta=$this->description;
            $this->ticket->AcctionsHistory()->save($acct); 
            $this->dispatch('saved');            
        }
        $this->hide_modal();
    }
    public function render()
    {
        return view('livewire.modals.return-ticket');
    }
}
