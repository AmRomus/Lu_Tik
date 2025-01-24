<?php

namespace App\Livewire\Support;

use App\Models\SupportTicket;
use App\Models\TicketComment;
use App\TicketTypes;
use Auth;
use Livewire\Component;

class ServiceTickets extends Component
{
    public $tickets;
    public $tname;
    public function mount($ttype)
    {
        switch(TicketTypes::tryFrom($ttype))
        {
            case TicketTypes::Support: 
                $this->tickets=SupportTicket::support()->get();
                $this->tname="Service";
                break;
            case TicketTypes::Uninstall:
                $this->tickets=SupportTicket::uninstall()->get();
                $this->tname="Uninstall";
                break;
            default:
                break;
        }
      
    }
    public function render()
    {
        
        return view('livewire.support.service-tickets');
    }
    public function delete_ticket($tid)
    {
        SupportTicket::find($tid)?->delete();
    }
    
}
