<?php

namespace App\Livewire\Widgets;

use App\Models\Onu;
use Carbon\Carbon;
use Livewire\Component;

class OptDev extends Component
{
    public $dev; 
    public $catv;
    public $active;
    public $timediff;
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
        $this->timediff=Carbon::parse($this->dev->last_state)->diffForhumans();
        return view('livewire.widgets.opt-dev');
    }
}
