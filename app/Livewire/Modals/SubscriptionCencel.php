<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use Bavix\Wallet\External\Dto\Extra;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class SubscriptionCencel extends Component
{
    public $account;
    public $refund_summ;
    public $do_refund=false;
    public $show;
    public function mount(BillingAccount $account_id)
    {
       $this->account=$account_id;
       if($account_id->Subscription){
       //$this->refund_days=$account_id->Subscription->created_at->diffInDays($account_id->Subscription->acct_end);
       $this->refund_summ=round($account_id->Subscription->created_at->diffInDays(Carbon::now())*$account_id->Subscription->tarif->getAmountProduct()/$account_id->Subscription->created_at->diffInDays($account_id->Subscription->acct_end),0);
       }
     
    }
    public function render()
    {
        
        return view('livewire.modals.subscription-cencel');
    }
    #[On('stop_subscription')]
    public function show_modal()
    {
        $this->show=!$this->show;
      
    }
    public function cencel_subscription()
    {        
        if($this->do_refund){
            $this->account->Tarif->forceTransfer($this->account,$this->refund_summ);
        }
        $subsc=$this->account->Subscription;
        $subsc->acct_end=Carbon::now();
        $subsc->save();
        $this->show_modal();
        $this->dispatch('saved');
    }
}
