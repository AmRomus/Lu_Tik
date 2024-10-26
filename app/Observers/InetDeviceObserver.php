<?php

namespace App\Observers;
use App\Models\BillingAccount;
use App\Models\InetDevices;
use Illuminate\Database\Eloquent\Collection;
use \RouterOS\Query;
use Log;
class InetDeviceObserver
{
    public function updated(InetDevices $device): void
    {
        if($device->wasChanged('online')){
            $ip = $device->getOriginal('ip');
            if($device->online==1){
                $ip=$device->ip;
                Log::debug("Device ".$device->mac." becomes online with IP: ".$ip );
            }            
            else 
            Log::debug("Device ".$device->mac." becomes Offline with IP: ".$ip);

            if($device->AccountInetService?->service_state==1)
            {                
                if($device->bind==1)
                {
                   
                }
            }
        }
        if($device->wasChanged('ip')){
            $mk=$device->ControlInterface->Mikrotik;           
             if($device->getOriginal('ip')!=null){
                $mk?->RemFromList($device->getOriginal('ip')); 
                $uac=BillingAccount::find($device->getOriginal('billing_account_id'));
                if($uac){
                    $mk?->DelQueue($uac); 
                    $mk?->AddQueue($uac);    
                }
                      
             }else 
             {
                if($device->ip!=null){
                    
                    $mk?->RemLease($device->mac);
                    Log::info("Start Add lease");
                    $mk?->AddLease($device);
                    $mk?->DelQueue($device->BillingAccount); 
                    $mk?->AddQueue($device->BillingAccount);   
                }
             }
        }
        // if($device->wasChanged('billing_account_id')){
        //     if($device->billing_account_id==null){               
        //         $device->ControlInterface->Mikrotik->RemLease($device->mac);
        //     }
        // }
       
    }
    public function deleted(InetDevices $device){
        dd($device);
    }
    public function created(InetDevices $device)
    {

    }
}
