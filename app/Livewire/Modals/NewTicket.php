<?php

namespace App\Livewire\Modals;

use App\Models\AcctionsHistory;
use App\Models\BillingAccount;
use App\Models\SupportTicket;
use App\Models\SupportType;
use App\TicketTypes;
use Auth;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewTicket extends Component
{
    public $show;
    #[Rule('required')]
    public $description;
    #[Rule('required')]
    public $taskdate;
    public $ticket;
    public $account;
    public $ticket_type=1;
    public $support_types;
    public $support_type;
    public $alter_phone;
    #[On('show_modal')]
    public function show_modal()
    {
        $this->show=!$this->show;      
    }
    public function hide_modal()
    {
        $this->show=false;
    }
    public function mount ($account)
    {
       $this->account=BillingAccount::find($account);
       $this->support_types=SupportType::all();  
       $this->support_type=SupportType::first()?->id;  
       $this->taskdate=Carbon::now()->addHours(SupportType::first()?->hrs);   
    }
    public function save()
    {
      //  dd($this->ticket_type);
        $this->validate();
        $st=new SupportTicket();
        $st->description=$this->description;
        $st->ticket_type=$this->ticket_type;
        $st->planed_time=$this->taskdate;
        $st->alter_phone=$this->alter_phone;
        if($this->ticket_type==1){
            $st->support_type_id=$this->support_type;
        }
        $st->user_id=Auth::user()->id;
        $this->account->SupportTicket()->save($st);
        $st->refresh();
        $acct= new AcctionsHistory();
        $acct->user_id=Auth::user()->id;
        $acct->acction="Create";
        if($this->ticket_type==0){
            $acct->meta="New connection ticket #".$st->id;
        } elseif ($this->ticket_type==0){
            $acct->meta="Support ticket #".$st->id;
        } else {
            $acct->meta="Uninstall ticket #".$st->id;
        }
        $st->AcctionsHistory()->save($acct);
        $this->hide_modal();
        $this->dispatch('saved');
    }
    public function updatedSupportType($value)
    {
        
        $st=SupportType::find($value);
        if($st){
           // dd($st);
            $this->taskdate=Carbon::now()->addHours($st->hrs);
        }
    }
    public function render()
    {
        $ttypes=TicketTypes::values();
        return view('livewire.modals.new-ticket',compact('ttypes'));
    }
}
