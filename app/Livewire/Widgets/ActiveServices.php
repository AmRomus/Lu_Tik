<?php

namespace App\Livewire\Widgets;

use App\Models\BillingAccount;
use Livewire\Component;

class ActiveServices extends Component
{
    public $inet=false;
    public $catv=false;
    public $iptv=false;
    public function mount(BillingAccount $account)
    {
        if($account->subscription)
        {
            $tarif=$account->subscription->tarif;
        }else 
        {
            $tarif=$account->tarif;
        }
        if($tarif){
            if($tarif->InetService) $this->inet=true;
            if($tarif->CatvService) $this->catv=true;
            if($tarif->IptvService) $this->iptv=true;
        }
       // dd($account);
    }
    public function render()
    {
        return view('livewire.widgets.active-services');
    }
}
