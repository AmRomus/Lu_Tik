<?php

namespace App\Livewire\Finances;

use App\Models\CatvService;
use App\Models\InetService;
use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TarifServices extends Component
{
    public $cur_tarif;
    #[Rule('required')]
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
    public function del_catv_service($service_id)
    {
        CatvService::find($service_id)?->delete();
        $this->cur_tarif->refresh();
    }
    public function save(){
        $this->validate([
            'name'=>'required|unique:tarifs,name,'.$this->cur_tarif->id,
        ]);
        $this->cur_tarif->name=$this->name;
        $this->cur_tarif->description=$this->description;
        $this->cur_tarif->save();
        $this->cur_tarif->refresh();
    }
}
