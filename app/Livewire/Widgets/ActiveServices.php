<?php

namespace App\Livewire\Widgets;

use App\Models\BillingAccount;
use App\Models\Tarif;
use Livewire\Component;

class ActiveServices extends Component
{
    public $inet=false;
    public $inet_owner;
    public $catv=false;
    public $catv_owner;
    public $iptv=false;
    public $iptv_owner;
    public function mount(Tarif $tarif)
    {
    
        if($tarif){
            if($tarif->InetService) {
                $this->inet=true;
                $this->inet_owner=$tarif->InetService->ServiceCompanies->Name;
            }
            if($tarif->CatvService) {
                $this->catv=true;
                $this->catv_owner=$tarif->CatvService->ServiceCompanies->Name;
            }
            if($tarif->IptvService) { 
                $this->iptv=true;
                $this->iptv_owner=$tarif->IptvService->ServiceCompanies->Name;
            }
        }
       // dd($account);
    }
    public function render()
    {
        return view('livewire.widgets.active-services');
    }
}
