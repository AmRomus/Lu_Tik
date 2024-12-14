<?php

namespace App\Livewire\Managment;

use App\Models\BillingAccount;
use App\Models\InetDevices;
use App\Models\Mikrotik;
use App\Models\Onu;
use Livewire\Attributes\On;
use Livewire\Component;

class EditAccount extends Component
{
    public $acc;
    public $account;
    public $devli;
    public function mount($billing_account)
    {
        $this->account=BillingAccount::findOrFail($billing_account);
        $this->acc=$this->account?->toArray();
        $this->devli=0;
    }
    public function render()
    {        
      
        return view('livewire.managment.edit-account');
    }
    #[On('saved')]
    public function refresh(){
        return redirect(request()->header('Referer'));
     
    }
    public function unlik_dev(InetDevices $dev){
       $dev->billing_account_id=null;
       $dev->ip=null;
       $dev->save();
       return redirect(request()->header('Referer'));
      // $this->account->refresh()->with('InetDevices');
    }
    public function unlik_catv_dev(Onu $dev){
        $dev->billing_account_id=null;       
        $dev->save();
        return redirect(request()->header('Referer'));
     }
}
