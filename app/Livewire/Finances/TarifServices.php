<?php

namespace App\Livewire\Finances;

use App\Models\InetService;
use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Component;

class TarifServices extends Component
{
    public $cur_tarif;
    public $name;  
    public $description;  
    public function render()
    {
      
        return view('livewire.finances.tarif-services');
    }
    #[On('show_tarif')]
    public function show_tarif($tarif)
    {        
        $this->cur_tarif=Tarif::find($tarif);
        $this->name=$this->cur_tarif?->name;
        $this->description = $this->cur_tarif?->description;
    }
    #[On('saved')]
    public function renew_services(){
       
        $this->cur_tarif->refresh();
    }
    public function del_inet_service($service_id){
        InetService::find($service_id)?->delete();
        $this->cur_tarif->refresh();
    }
}
