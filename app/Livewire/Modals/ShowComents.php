<?php

namespace App\Livewire\Modals;

use App\Models\SupportTicket;
use App\Models\TicketComment;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ShowComents extends Component
{
    public $show;
    public $item;
    public $comments=[];
    #[Rule('required')]
    public $comment_text;
    #[On('show_modal')]
    public function show_modal($tid)
    {
        $this->show=true;       
        $this->item=SupportTicket::with('TicketComment')->find($tid);
        $this->comments=$this->item?->TicketComment;
    }
   
    #[On('hide_modal')]
    public function hide_modal()
    {
        $this->show=false;
        $this->item=null;
    }
    public function render()
    {
        return view('livewire.modals.show-coments');
    }
    public function add_comment()
    {
        $this->validate();
        $tc=new TicketComment();
        $tc->user_id=Auth::user()->id;
        $tc->comment=$this->comment_text;
        $this->item->TicketComment()->save($tc);
        $this->item->refresh();
        $this->comments=$this->item->TicketComment;
        $this->comment_text=null;
    }
}
