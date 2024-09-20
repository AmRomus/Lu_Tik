<?php

namespace App\Livewire\Modals;

use App\Livewire\Finances\TarifServices;
use App\Models\InetService;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewInetServices extends Component
{
    public $show;
    #[Rule('required')]
    public $service_tarif;
    #[Rule('required|integer')]
    public $devices_count;
    public $speed_up;
    public $speed_down;
    #[Rule('required|integer')]
    public $price;
    #[On('show_modal')]
    public function show_modal($tarif=null)
    {      
      $this->show=!$this->show;      
      if($tarif)
      {
        $this->service_tarif=$tarif;
        $this->price=0;
        $this->speed_up=0;
        $this->speed_down=0;
      }
    }

    public function render()
    {
        return view('livewire.modals.new-inet-services');
    }
    public function save()
    {
        $this->validate();
        InetService::create([
            'tarif_id'=>$this->service_tarif,
            'devices_count'=>$this->devices_count,
            'speed_up'=>$this->speed_up,
            'speed_down'=>$this->speed_down,
            'price'=>$this->price,
        ]);
        $this->show_modal();
        $this->dispatch('saved')->to(TarifServices::class);
    }
}
