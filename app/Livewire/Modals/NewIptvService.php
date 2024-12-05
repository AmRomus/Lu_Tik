<?php

namespace App\Livewire\Modals;

use App\Livewire\Finances\TarifServices;
use App\Models\IptvService;
use App\Models\PlayList;
use App\Models\ServiceCompanies;
use App\Models\Tarif;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class NewIptvService extends Component
{
    public $show;
    public $service_tarif;
    public $companyes;
    public $price;
    public $cur_service;
    public $selected_company;
    #[Rule('required|integer')]
    public $iptv_devices;
    #[Rule('required|integer')]
    public $smart_devices;

    public $playlists;
    public $selected_playlist;
    public function mount()
    {
      $this->companyes = ServiceCompanies::all();
      $this->selected_company=ServiceCompanies::first()?->id;
      $this->playlists= PlayList::all();
      $this->selected_playlist=PlayList::first()?->id;
    }
    public function render()
    {
        return view('livewire.modals.new-iptv-service');
    }
    #[On('show_modal')]
    public function show_modal($tarif=null)
    {      
      $this->show=!$this->show;  
      
      if($tarif)
      {
        $this->cur_service=Tarif::find($tarif)->IptvService;        
        if(!$this->cur_service){         
          $this->service_tarif=$tarif;
          $this->price=0;
          
        }else 
        {
          $this->service_tarif=$tarif;
          $this->selected_company=$this->cur_service->ServiceCompanies->id;
          $this->selected_playlist=$this->cur_service->PlayList?->id;
          $this->price=$this->cur_service->price;
          $this->iptv_devices=$this->cur_service->iptv_devices;
          $this->smart_devices = $this->cur_service->smart_devices;
         
        }
      }
    }
    public function save()
    {
        $this->validate();
        if(!$this->cur_service){
          IptvService::create([
              'tarif_id'=>$this->service_tarif,                      
              'price'=>$this->price,
              'play_list_id'=>$this->selected_playlist,
              'iptv_devices'=>$this->iptv_devices,
              'smart_devices'=>$this->smart_devices,
              'service_companies_id'=>$this->selected_company,
          ]);
        }else {
         
          $this->cur_service->price=$this->price;
          $this->cur_service->play_list_id=$this->selected_playlist;
          $this->cur_service->smart_devices=$this->smart_devices;
          $this->cur_service->iptv_devices=$this->iptv_devices;
          $this->cur_service->service_companies_id=$this->selected_company;
          $this->cur_service->save();
          $this->cur_service->refresh();
        }
        $this->show_modal();
        $this->dispatch('saved')->to(TarifServices::class);
      
    }
}
