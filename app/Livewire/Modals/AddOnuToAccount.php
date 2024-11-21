<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use App\Models\Onu;
use Livewire\Attributes\On;
use Livewire\Component;

class AddOnuToAccount extends Component
{
    public $selected_onu;
    public $free_onus=[];
    public $account;
    public $onu_mac;
    public function mount($account_id)
    {
        $this->account=BillingAccount::findOrFail($account_id);       
    }
    public function render()
    {
        return view('livewire.modals.add-onu-to-account');
    }
    public $show;
    #[On('show_modal')]
    public function show_modal()
    {
        $this->show=!$this->show;
    }

    public function updatedOnuMac($value)
    {
       $try_macs=Onu::where('mac','LIKE','%'.$value.'%')->take(5)->pluck('mac','id');
       if($try_macs)
       {
         $this->free_onus=$try_macs;
       }else 
       {
        $this->free_onus=[];
       }
       
    }
    public function bind(Onu $onu)
    {
        $this->account->onu()->save($onu);
        //$onu->BillingAccount()->save($this->account);
        $this->dispatch('saved');
        $this->show_modal();
    }
}
