<?php

namespace App\Livewire\Support;

use App\Models\SupportTicket;
use Livewire\Component;

class ReqEdit extends Component
{
    public $ticket;
    public function mount($tid)
    {
        $this->ticket=SupportTicket::findOrFail($tid);
    }
    public function render()
    {
        return view('livewire.support.req-edit');
    }
}
