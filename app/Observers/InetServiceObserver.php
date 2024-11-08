<?php

namespace App\Observers;
use App\Models\InetService;
use Illuminate\Database\Eloquent\Collection;

class InetServiceObserver
{
    private $last_mk=-1;
    public function updated(InetService $service)
    {
        $this->last_mk=-1;
       
        if( array_diff($service->getOriginal(), $service->getAttributes())==2&&$service->wasChanged('price')) return;
        foreach($service->Tarif->BillingAccount as $account)
        {
           
            $account->InetDevices?->each(function($item) use($account)
            {
                if($item->ControlInterface){
                    $mk=$item->ControlInterface->Mikrotik; 
                    if($mk->id!=$this->last_mk){               
                        $mk?->DelQueue($account);                     
                        $mk?->AddQueue($account);
                        $this->last_mk=$mk->id;
                    }
                }
               // $renew_collection->push($item);
            });
            
        }
        
    }
}
