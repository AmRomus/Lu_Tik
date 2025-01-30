<?php

namespace App\Livewire\Support;

use App\Models\AcctionsHistory;
use App\Models\SupportTicket;
use Auth;
use Livewire\Component;

class SupportList extends Component
{
    public $for_install;
    public $for_support;
    public $for_uninstall;
    public function mount()
    {
       
    }
    public function render()
    {
        $this->for_install=Auth::user()->SupportTicket()->Connections()->orderBy('planed_time')->get();
        $this->for_support=Auth::user()->SupportTicket()->Support()->get();
        $this->for_uninstall=Auth::user()->SupportTicket()->Uninstall()->get();
        return view('livewire.support.support-list');
    }
    public function close_connection($tid)
    {
        $t=SupportTicket::find($tid);
        if($t)
        {
            $t->processed=true;
            $t->save();          
            $acct= new AcctionsHistory();
            $acct->user_id=Auth::user()->id;
            $acct->acction="Ticket Processed";          
            $t->AcctionsHistory()->save($acct); 
            $this->redirect(request()->header('Referer'));       
        }
       

    }
}
