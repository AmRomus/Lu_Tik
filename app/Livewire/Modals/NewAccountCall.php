<?php

namespace App\Livewire\Modals;

use App\Models\AccountCalls;
use App\CallTypes;
use App\Models\BillingAccount;
use Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NewAccountCall extends Component
{
    public $show;
    public $account;
    public $theme;
    public $cal;
    public $solved=false;
    public $call_types;
    public function mount(BillingAccount $account){
        $this->account=$account;
        $this->call_types=CallTypes::values();
        $this->cal=CallTypes::Info;
    }
    #[On('show_modal')]
    public function show_modal()
    {
        $this->show=!$this->show;
    }
    public function render()
    {
        return view('livewire.modals.new-account-call');
    }
    public function save()
    {
        $call= new AccountCalls();
        $call->solved=$this->solved;
        $call->theme=$this->theme;
        $call->call_type=$this->cal;
        $call->user_id=Auth::user()?->id;
        $this->account->AccountCalls()->save($call);
        $this->show_modal();
        $this->dispatch('saved');
    }
}
