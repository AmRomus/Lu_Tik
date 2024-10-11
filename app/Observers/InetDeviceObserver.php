<?php

namespace App\Observers;
use App\Models\InetDevices;
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
    }
}
