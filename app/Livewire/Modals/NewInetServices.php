<?php

namespace App\Livewire\Modals;

use App\Livewire\Finances\Tarifs;
use App\Livewire\Finances\TarifServices;
use App\Models\InetService;
use App\Models\ServiceCompanies;
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
    #[Rule('required|integer|gte:0')]
    public $burst_percent;
    #[Rule('required|integer|gt:0')]
    public $burst_time;
    #[Rule('required|integer|gte:0')]
    public $price;
    public $companyes;
    
    public $cur_service;
    public $selected_company;
    public function mount()
    {
      $this->companyes = ServiceCompanies::all();

    }
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
          $this->selected_company=$this->cur_service->ServiceCompanies->id;
          $this->price=$this->cur_service->price;
          $this->speed_up=$this->cur_service->speed_up;
          $this->speed_up_unit = $this->cur_service->speed_up_unit;
          $this->speed_down=$this->cur_service->speed_down;
          $this->speed_down_unit=$this->cur_service->speed_down_unit;
          $this->burst_percent=$this->cur_service->burst_percent;
          $this->burst_time=$this->cur_service->burst_time;
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
              'burst_percent'=>$this->burst_percent,
              'burst_time'=>$this->burst_time,
              'service_companies_id'=>$this->selected_company,
              'price'=>$this->price,
          ]);
        }else {
          $this->cur_service->speed_up=$this->speed_up;
          $this->cur_service->speed_up_unit=$this->speed_up_unit;
          $this->cur_service->speed_down=$this->speed_down;
          $this->cur_service->speed_down_unit = $this->speed_down_unit;
          $this->cur_service->burst_percent=$this->burst_percent;
          $this->cur_service->burst_time=$this->burst_time;
          $this->cur_service->price=$this->price;
          $this->cur_service->service_companies_id=$this->selected_company;
          $this->cur_service->save();
          $this->cur_service->refresh();
        }
        $this->show_modal();
        $this->dispatch('saved')->to(TarifServices::class);
        $this->dispatch('saved')->to(Tarifs::class);
    }
}
