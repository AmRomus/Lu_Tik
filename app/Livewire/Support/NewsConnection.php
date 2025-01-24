<?php

namespace App\Livewire\Support;

use App\Models\SupportTicket;
use Carbon\Carbon;
use Livewire\Component;

class NewsConnection extends Component
{
  
    public function render()
    {       
        $tickets=SupportTicket::Connections()->select(['id','planed_time'])->get();      
        return view('livewire.support.news-connection',compact('tickets'));
    }
    public function delete_ticket($tid)
    {
        SupportTicket::find($tid)?->delete();
    }
}
