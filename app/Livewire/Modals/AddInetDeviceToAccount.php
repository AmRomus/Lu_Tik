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
   
    #[Rule('required|mac_address')]
    public $mac;

    public $interface;
    public $ipaddr;
    public $mikrotik;
    public $bind_select;
    public $ret=[];
    public $key;
    public $ipdevice;
    public $ip;
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
            $this->mac=$this->ipdevice->mac;
            $this->ip=$this->ipdevice->ip;
            // foreach(Mikrotik::all() as $mk)
            // {
            //     $mcs=$mk->findDevice($this->ipdevice->mac);
            //     if(count($mcs)>0){
            //         foreach($mcs as $m){
            //             array_push($this->ret,$m);
            //         }
            //     }
               
            //     $this->mac=$this->ipdevice->mac;
               
            // }
        }
        $this->show=!$this->show;        
       
    }
    public function search_mac()
    {
        $this->ret=[];
        $this->validate();        
        $this->ipdevice=InetDevices::where('mac',$this->mac)->first();
        foreach(Mikrotik::all() as $mk)
        {          
            $mcs=$mk->findDevice($this->mac);
            if(count($mcs)>0){
                foreach($mcs as $m){
                    array_push($this->ret,$m);
                }
            }
                    
        }
    }
  
    public function bind($key){
        if($this->bind_select){
        foreach($this->ret as $del=>$list)
        {
            if($del!=$key) unset($this->ret[$del]);
        }  
        $this->key=$key; 
        } else {
            $this->key=null;
            $this->updatedMac();
        }
      
    }
    public function save()
    {
        if(!$this->ipdevice)
            $this->ipdevice=new InetDevices();
        $this->ipdevice->mac= $this->mac;
        $this->account->InetDevices()->save($this->ipdevice);
        $this->ipdevice->refresh();
       
        if($this->key!==null){
           
            $this->ipdevice->bind=true;           
            $this->ipdevice->ip=$this->ret[$this->key]->address;            
            $this->ret[$this->key]->mk->ControlInterface->where('interface',$this->ret[$this->key]->interface)->first()->InetDevices()->save($this->ipdevice);
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
