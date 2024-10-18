<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Attributes\On;

class CashPay extends Component
{
    public $show;
    public $account;
    #[Rule('required|integer|gt:0')]
    public $summ;
    public function render()
    {
        return view('livewire.modals.cash-pay');
    }
    #[On('show_modal')]
    public function show_modal($account=null)
    {   
        if($account)$this->account=BillingAccount::find($account); 
        $this->show=!$this->show;
    }
    public function make_paymant(){
        if($this->account){
            Auth::user()->forceTransfer($this->account,$this->summ);
            $this->account=null;
            $this->show_modal();
            $this->dispatch('saved');
        }
    }
}
