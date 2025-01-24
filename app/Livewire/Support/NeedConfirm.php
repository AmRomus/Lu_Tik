<?php

namespace App\Livewire\Support;

use App\Models\AcctionsHistory;
use App\Models\SupportTicket;
use Auth;
use Livewire\Component;

class NeedConfirm extends Component
{
    public function render()
    {
        $tickets=SupportTicket::waitConfirm()->get();        
        return view('livewire.support.need-confirm',compact('tickets'));
    }
    public function close($tik)
    {
        $ticket=SupportTicket::find($tik);
        if($ticket)
        {
            $ticket->finished=true;
            $ticket->finished_id=Auth::user()->id;
            $ticket->save();
            $acct= new AcctionsHistory();
            $acct->user_id=Auth::user()->id;
            $acct->acction="Ticket closed";          
            $ticket->AcctionsHistory()->save($acct); 
            $this->dispatch('saved');            
        }
    }
}
