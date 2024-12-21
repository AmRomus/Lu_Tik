<?php

namespace App\Livewire\Modals;

use App\Models\AccountCatvService;
use App\Models\MikroBillApi;
use Livewire\Attributes\On;
use Livewire\Component;

class SetCatvServiceApi extends Component
{
    public $apis;
    public $apis_id;
    public $api_ident;
    public $show;
    public $api_uuid;
    public $sapi;
    public $service_id;
    public function mount()
    {
       
        $this->apis = MikroBillApi::all();
    }
    #[On('show_modal')]
    public function show_modal($service_id=null)
    {
        
           if($service_id)
           {
            $this->service_id = AccountCatvService::find($service_id);
            $this->show=!$this->show; 
           }
           else {
            $this->show=!$this->show; 
           }
            
    }

    public function render()
    {
        return view('livewire.modals.set-catv-service-api');
    }
    public function updatedApiIdent($value){        
        $this->sapi=MikroBillApi::find($this->apis_id);
         if($this->sapi){
             $JSON=json_decode($this->sapi->Process('API.GetClients',$value),true);
             if($JSON['code']==0)
             {
                 $this->api_uuid=$JSON['return'][0];
                 
             }else 
             {
                 $this->api_uuid=null;
             }
         }else{ $this->api_uuid=null; };
     
     }
    public function save_api()
    {
       
        if($this->apis_id){
            $this->sapi->AccountCatvService()->save($this->service_id);          
           $this->service_id->api_ident= $this->api_ident;
           $this->service_id->api_ssid=$this->api_uuid;
           $this->service_id->api_check=null;

          }else 
          {
            $this->service_id->mikro_bill_api_id=null;
            $this->service_id->api_ident=null;
            $this->service_id->api_ssid=null;
            $this->service_id->api_check=null;
            $this->service_id->service_state=0;

          }
          
          $this->service_id->save();
          $this->service_id->refresh();          
          $this->dispatch('saved');
          $this->show_modal();
    }
}
