<?php

namespace App\Livewire\Modals;

use App\Models\AccountInetService;
use App\Models\BillingAccount;
use App\Models\InetDevices;
use App\Models\InetService;
use App\Models\Mikrotik;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AddInetDeviceToAccount extends Component
{
    public $account;
    public $account_service;
    #[Rule('required|mac_address')]
    public $mac;

    public $interface;
    public $ipaddr;
    public $mikrotik;
    public $bind_select;
    public $ret=[];
    public $key;
    public $ipdevice;
    public function mount($account_id)
    {
        $this->account=BillingAccount::findOrFail($account_id);
    }
    public function render()
    {
        return view('livewire.modals.add-inet-device-to-account');
    }
    public $show;
    #[On('show_modal')]
    public function show_modal($service_id=null)
    {
        $this->show=!$this->show;
        $this->account_service=AccountInetService::find($service_id);
       
    }
    public function updatedMac()
    {
        $this->validate();
        $this->ipdevice=InetDevices::where('mac',$this->mac)->first();
        foreach(Mikrotik::all() as $mk)
        {
            $this->ret=$mk->findDevice($this->mac);
            $this->mikrotik=$mk;
           break;
        }
    }
    public function bind($key){
        foreach($this->ret as $del=>$list)
        {
            if($del!=$key) unset($this->ret[$del]);
        }  
        $this->key=$key;     
    }
    public function save()
    {
        if(!$this->ipdevice)
            $this->ipdevice=new InetDevices();
        $this->ipdevice->mac= $this->mac;
        $this->account_service->InetDevices()->save($this->ipdevice);
        $this->ipdevice->refresh();
        $this->account->InetDevices()->save($this->ipdevice);
        $this->dispatch('saved');
        $this->show_modal();
    }
}
