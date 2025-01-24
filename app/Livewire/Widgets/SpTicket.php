<?php

namespace App\Livewire\Widgets;


use App\Models\SupportTicket;
use App\Models\TicketComment;
use Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class SpTicket extends Component
{
    public $allow_comment;
    public $comments=[];
    public $item;
    #[Rule('required')]
    public $comment_text;
    #[On('saved')]
    public function render()
    {
        return view('livewire.widgets.sp-ticket');
    }
    public function mount(SupportTicket $tid)
    {
        $this->item=$tid;
    }
    public function toggle_comments()
    {
        if(count($this->comments)==0)
        {
            $this->comments=$this->item->TicketComment;
            $this->allow_comment=true;
        }else 
        {
            $this->comments=[];
            $this->allow_comment=false;
        }
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
