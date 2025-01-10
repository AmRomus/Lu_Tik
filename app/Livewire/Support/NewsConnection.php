<?php

namespace App\Livewire\Support;

use App\Models\SupportTicket;
use Livewire\Component;

class NewsConnection extends Component
{
    public function render()
    {
        $tickets=SupportTicket::Connections()->get();
        return view('livewire.support.news-connection',compact('tickets'));
    }
}
