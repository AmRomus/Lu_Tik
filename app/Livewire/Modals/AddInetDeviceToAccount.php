<?php

namespace App\Livewire\Modals;

use App\Models\BillingAccount;
use App\Models\InetDevices;
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
        $this->account_service=$service_id;
    }
    public function updatedMac()
    {
        $this->validate();
        $ipdevice=InetDevices::where('mac',$this->mac)->first();
        foreach(Mikrotik::all() as $mk)
        {
            $this->ret=$mk->findDevice($this->mac);
            $this->mikrotik=$mk;
           break;
           // dd($ret);
            // if(count($ret)>0){
            //     $this->ipaddr=$ret[0]['address'];
            //     $this->interface=$ret[0]['interface'];
            //     $this->mikrotik=$mk;
            //     $dhcp = $mk->findDhcp($this->mac);
            //     //dd($dhcp);
            //     break;
            // }
        }
       
      //  dd($ipdevice);
    }
    public function bind($key){
        foreach($this->ret as $del=>$list)
        {
            if($del!=$key) unset($this->ret[$del]);
        }
       // dd($this->bind_select,$key);
    }
}
