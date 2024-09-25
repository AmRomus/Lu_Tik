<?php

namespace App\Observers;

use App\Models\AccountInetService;
use App\Models\BillingAccount;
use App\Models\Tarif;

class BillingAccountObserver
{
    /**
     * Handle the BillingAccount "created" event.
     */
    public function created(BillingAccount $billingAccount): void
    {
        $billingAccount->AccountInetService()->save(new AccountInetService());
    }

    /**
     * Handle the BillingAccount "updated" event.
     */
    public function updated(BillingAccount $billingAccount): void
    {
       if($billingAccount->wasChanged('tarif_id'))
       {
          $tarif =Tarif::find($billingAccount->tarif_id);
          if($billingAccount->AccountInetService)
          {
            if($tarif?->InetService)
            {               
                $tarif->InetService->AccountInetService()->save($billingAccount->AccountInetService);               
            }else 
            {
                $billingAccount->AccountInetService->inet_service_id=null;
                $billingAccount->AccountInetService->mikro_bill_api_id=null;
                $billingAccount->AccountInetService->save();
            }
          }else
          {
            $billingAccount->AccountInetService()->save(new AccountInetService());
            if($tarif?->InetService)
            {               
                $tarif->InetService->AccountInetService()->save($billingAccount->AccountInetService);               
            }else 
            {
                $billingAccount->AccountInetService->inet_service_id=null;
                $billingAccount->AccountInetService->mikro_bill_api_id=null;
                $billingAccount->AccountInetService->save();
            }
          }
       }
    }

    /**
     * Handle the BillingAccount "deleted" event.
     */
    public function deleted(BillingAccount $billingAccount): void
    {
        //
    }

    /**
     * Handle the BillingAccount "restored" event.
     */
    public function restored(BillingAccount $billingAccount): void
    {
        //
    }

    /**
     * Handle the BillingAccount "force deleted" event.
     */
    public function forceDeleted(BillingAccount $billingAccount): void
    {
        //
    }
}
