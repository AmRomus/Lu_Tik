<?php

namespace App\Livewire\Modals;

use App\Models\AcctionsHistory;
use App\Models\SupportTicket;
use App\ProcessedRelation;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CloseTicket extends Component
{
    public $show;
 
    public $description;
    public $ticket;
    public $account;
    public $processed_relation=0;
    public $processed_relations;
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
        $this->processed_relations=ProcessedRelation::values();
    }
    public function save()
    {
       
        if($this->ticket){
            $this->ticket->processed=true;
            $this->ticket->processed_relation=$this->processed_relation;
            $this->ticket->save();
            $acct= new AcctionsHistory();
            $acct->user_id=Auth::user()->id;
            $acct->acction="Ticket Processed";
            $acct->meta=$this->description;
            $this->ticket->AcctionsHistory()->save($acct); 
            $this->dispatch('saved');            
        }
        $this->hide_modal();
    }
    public function render()
    {
        return view('livewire.modals.close-ticket');
    }
}
