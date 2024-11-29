<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use Bavix\Wallet\External\Dto\Extra;
use Bavix\Wallet\External\Dto\Option;
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
       //cena za den'
       $day_price=$account_id->Subscription->tarif->getAmountProduct()/$account_id->Subscription->created_at->diffInDays($account_id->Subscription->acct_end);
       $spent_summ=$account_id->Subscription->created_at->diffInDays(Carbon::now())*$day_price;
       $this->refund_summ=round($account_id->Subscription->tarif->getAmountProduct()-$spent_summ,0);
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
            $days = $this->account->Subscription->created_at->diffInDays($this->account->Subscription->acct_end);
            $used_days=$this->account->Subscription->created_at->diffInDays(Carbon::now());
             /// naxodimm servisy i vozvrashaem den'gi
            $inet_service=$this->account->Subscription->tarif->InetService;
            $catv_service=$this->account->Subscription->tarif->CatvService;
            if($inet_service){
              $w=$this->account->getWallet('wallet_'.$inet_service->ServiceCompanies->id);
              //cena za den' 
              if($days&&$days!=0){                
                 $day_price=$inet_service->price/$days;
                 $unused_money=($days-$used_days)*$day_price;            
                 $inet_service->ServiceCompanies->transfer($w,round($unused_money,0),new Extra(
                     deposit: [
                         'type' => 'refund for '.$this->account->Subscription->tarif->name,
                     ],                        
                     withdraw: new Option(
                         [
                             'type' => 'refund to '.$this->account->ident,
                         ],
                         true // confirmed
                     ),
                     extra: [
                         'msg' => 'refund for tarif '.$this->account->Subscription->tarif->name." -> Inet Service to ".$this->account->ident,
                     ],
                 ));
              }
             }
              if($catv_service){
                 $w=$this->account->getWallet('wallet_'.$catv_service->ServiceCompanies->id);
                 //cena za den' 
                 if($days&&$days!=0){
                    $day_price=$catv_service->price/$days;
                    $unused_money=($days-$used_days)*$day_price;
                    $catv_service->ServiceCompanies->transfer($w,round($unused_money,0),new Extra(
                        deposit: [
                            'type' => 'refund for '.$this->account->Subscription->tarif->name,
                        ],                        
                        withdraw: new Option(
                            [
                                'type' => 'refund to '.$this->account->ident,
                            ],
                            true // confirmed
                        ),
                        extra: [
                            'msg' => 'refund for tarif '.$this->account->Subscription->tarif->name." -> Inet Service to ".$this->account->ident,
                        ],
                    ));
                 }
              
            }
     
         //    $day_price=$account_id->Subscription->tarif->getAmountProduct()/;
         //    $spent_summ=*$day_price;
         //    $this->refund_summ=round($account_id->Subscription->tarif->getAmountProduct()-$spent_summ,0);
           //  $account_id->Subscription->acct_end=Carbon::now();
          //   $account_id->Subscription->save();
        }
        $subsc=$this->account->Subscription;
        $subsc->acct_end=Carbon::now();
        $subsc->save();
        $this->show_modal();
        $this->dispatch('saved');
    }
}
