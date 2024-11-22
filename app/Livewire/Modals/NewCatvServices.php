<?php

namespace App\Livewire\Modals;

use App\Models\CatvService;
use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Livewire\Finances\TarifServices;

class NewCatvServices extends Component
{
    public $show;
    public $service_tarif;
    #[Rule('required|integer|gte:0')]
    public $price;
    public $cur_service;
    #[On('show_modal')]
    public function show_modal($tarif=null)
    {      
      $this->show=!$this->show;      
      if($tarif)
      {
        $this->cur_service=Tarif::find($tarif)->CatvService;
        if(!$this->cur_service){
          $this->service_tarif=$tarif;
          $this->price=0;        
          $this->cur_service=null;       
        }else 
        {
          $this->service_tarif=$tarif;
          $this->price=$this->cur_service->price;          
        }
      }
    }
    public function render()
    {
        return view('livewire.modals.new-catv-services');
    }
    public function save()
    {
        $this->validate();
        if(!$this->cur_service){
          CatvService::create([
              'tarif_id'=>$this->service_tarif,                      
              'price'=>$this->price,
          ]);
        }else {
         
          $this->cur_service->price=$this->price;
          $this->cur_service->save();
          $this->cur_service->refresh();
        }
        $this->show_modal();
        $this->dispatch('saved')->to(TarifServices::class);
      
    }
}
