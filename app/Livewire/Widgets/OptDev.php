<?php

namespace App\Livewire\Widgets;

use App\Models\Onu;
use Livewire\Component;

class OptDev extends Component
{
    public $dev; 
    public $catv;
    public $active;
    public function mount( $dev){
        $this->dev = Onu::find($dev); 
        $account=$this->dev?->BillingAccount;
        if($account->subscription)
        {
            $tarif=$account->subscription->tarif;
        }else 
        {
            $tarif=$account->tarif;
        }
        if($tarif)
        {
            if($tarif->CatvService) {
                $this->catv=true;
                $this->active=($account->CatvAccess<0)?true:false;
            }
        }          
    }
    public function render()
    {
        return view('livewire.widgets.opt-dev');
    }
}
