<?php

namespace App\Observers;

use App\Models\AccountCatvService;
use Log;

class AccountCatvServiceObserver
{
     public function updated(AccountCatvService $service)
     {
        if($service->wasChanged('service_state')){           
            foreach($service->BillingAccount->onu as $onu){
                if($service->service_state<0)
                {
                    $onu->CatvOn();
                }
                Log::debug($onu->mac);
            }
        }
       
     }
}
