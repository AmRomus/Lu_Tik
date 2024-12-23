<?php

namespace App\Livewire\Managment;

use App\Models\BillingAccount;
use App\Models\InetDevices;
use App\Models\IptvDevice;
use App\Models\Mikrotik;
use App\Models\Onu;
use App\Models\ServiceCompanies;
use Livewire\Attributes\On;
use Livewire\Component;
use Auth;

class EditAccount extends Component
{
    public $acc;
    public $account;
    public $devli;
    public $subscr;
    public $alowed_wallets= array();   
    public function mount($billing_account)
    {
        $companies=ServiceCompanies::all();
        $this->account=BillingAccount::with(['tarif','AccountInetService','AccountCatvService','Address','onu'])
        ->findOrFail($billing_account);
        if($this->account){
            foreach($companies as $company){
                if(!$this->account->hasWallet("wallet_".$company->id))
                {
                    $this->account->createWallet([
                        'name' => $company->Name,
                        'slug' => "wallet_".$company->id,
                    ]);
                }
            }
        }
        $alowed_wallets_id=Auth::user()->ServiceCompany->pluck('id')->toArray();
        foreach($alowed_wallets_id as $cid)
        {
            $this->alowed_wallets[]='wallet_'.$cid;
        //    array_push($this->alowed_wallets,'wallet_'.$cid);          
        }
       
        $this->subscr=$this->account->Subscriptions->first();
       // $this->acc=$this->account?->toArray();
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
     public function unlik_iptv_dev(IptvDevice $dev)
     {
        if($dev)
        {
            $dev->delete();
            return redirect(request()->header('Referer'));
        }
     }
     public function reboot_onu(Onu $onu)
     {
        if($onu)
        {
            $onu->reboot();
        }
     }
}
