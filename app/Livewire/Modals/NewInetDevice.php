<?php

namespace App\Livewire\Modals;

use App\Models\InetDevices;
use App\Models\Mikrotik;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewInetDevice extends Component
{
    #[Rule('required|mac_address|unique:inet_devices,mac')]
    public $mac;
    public $show;
    #[On('show_modal')]
    public function show_modal()
    {
        $this->show=!$this->show;
    }
    public function render()
    {
        return view('livewire.modals.new-inet-device');
    }
    public function updatedNewmac(){
        $this->validate();
    }
    public function save()
    {
        $this->validate();
        // $dev_array=array();
        // foreach(Mikrotik::all() as $mk){
        //   array_push($dev_array,$mk->findDevice($this->mac));
        // }
        // dd($dev_array);
        InetDevices::create([
            'mac'=>$this->mac
        ]);
        $this->dispatch('saved');
        $this->show_modal();
    }
}
