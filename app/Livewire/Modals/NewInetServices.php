<?php

namespace App\Livewire\Modals;

use App\Livewire\Finances\Tarifs;
use App\Livewire\Finances\TarifServices;
use App\Models\InetService;
use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewInetServices extends Component
{
    public $show;
    #[Rule('required')]
    public $service_tarif;    
    public $speed_up;
    public $speed_up_unit;
    public $speed_down;
    public $speed_down_unit;
    #[Rule('required|integer|gt:0')]
    public $price;
    public $cur_service;

    #[On('show_modal')]
    public function show_modal($tarif=null)
    {      
      $this->show=!$this->show;      
      if($tarif)
      {
        $this->cur_service=Tarif::find($tarif)->InetService;
        if(!$this->cur_service){
          $this->service_tarif=$tarif;
          $this->price=0;
          $this->speed_up=0;
          $this->speed_down=0;
          $this->cur_service=null;
          $this->speed_up_unit =null;
          $this->speed_down_unit=null;
        }else 
        {
          $this->service_tarif=$tarif;
          $this->price=$this->cur_service->price;
          $this->speed_up=$this->cur_service->speed_up;
          $this->speed_up_unit = $this->cur_service->speed_up_unit;
          $this->speed_down=$this->cur_service->speed_down;
          $this->speed_down_unit=$this->cur_service->speed_down_unit;
        }
      }
    }

    public function render()
    {
        return view('livewire.modals.new-inet-services');
    }
    public function save()
    {
        $this->validate();
        if(!$this->cur_service){
          InetService::create([
              'tarif_id'=>$this->service_tarif,          
              'speed_up'=>$this->speed_up,
              'speed_up_unit'=>$this->speed_down_unit,
              'speed_down'=>$this->speed_down,
              'speed_down_unit'=>$this->speed_down_unit,
              'price'=>$this->price,
          ]);
        }else {
          $this->cur_service->speed_up=$this->speed_up;
          $this->cur_service->speed_up_unit=$this->speed_up_unit;
          $this->cur_service->speed_down=$this->speed_down;
          $this->cur_service->speed_down_unit = $this->speed_down_unit;
          $this->cur_service->price=$this->price;
          $this->cur_service->save();
          $this->cur_service->refresh();
        }
        $this->show_modal();
        $this->dispatch('saved')->to(TarifServices::class);
        $this->dispatch('saved')->to(Tarifs::class);
    }
}
