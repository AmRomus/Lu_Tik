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
    public function show_modal($device_id=null)
    {
       
        if($device_id!=null){
            $this->ipdevice=InetDevices::find($device_id);
            foreach(Mikrotik::all() as $mk)
        {
            $this->ret=$mk->findDevice($this->ipdevice->mac);
            $this->mac=$this->ipdevice->mac;
            $this->mikrotik=$mk;
           break;
        }
        }
        $this->show=!$this->show;        
       
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
        $this->account->InetDevices()->save($this->ipdevice);
        $this->ipdevice->refresh();
        if($this->key){
            $this->ipdevice->bind=true;           
            $this->ipdevice->ip=$this->ret[$this->key]['address'];
            $this->mikrotik->ControlInterface->where('interface',$this->ret[$this->key]['interface'])->first()->InetDevices()->save($this->ipdevice);
            $this->ipdevice->refresh();
            
        }else {
            $this->ipdevice->bind=false;
            $this->ipdevice->save();
            $this->ipdevice->refresh();
        }
        $this->dispatch('saved');
        $this->show_modal();
    }
}
