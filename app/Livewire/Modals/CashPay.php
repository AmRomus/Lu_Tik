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
    public $w;
    #[Rule('required|integer|gt:0')]
    public $summ;
    public function mount($account_id)
    {
        $this->account=BillingAccount::find($account_id); 
    }
    public function render()
    {
        return view('livewire.modals.cash-pay');
    }
    #[On('show_modal')]
    public function show_modal($wallet_name=null)
    { 
        if($wallet_name)
        {
            $this->w=$this->account->getWallet($wallet_name);          
        }  
       
        $this->show=!$this->show;
    }
    public function make_paymant(){
        if($this->account&&$this->w){
            Auth::user()->forceTransfer($this->w,$this->summ);
            $this->w=null;
            $this->show_modal();
            $this->dispatch('saved');
        }
    }
}
