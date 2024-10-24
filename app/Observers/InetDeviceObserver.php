<?php

namespace App\Observers;
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
            //@todo
            //remove old lease if present
           
            $lease = $device->ControlInterface->Mikrotik->Link?->q((new Query('/ip/dhcp-server/lease/print'))->where('mac-address',$device->mac))->r();
          
         
            //add new lease
        }
        if($device->wasChanged('billing_account_id')){
            if($device->billing_account_id==null){
               $link=$device->ControlInterface->Mikrotik->Link;
                $lease = $link?->q((new Query('/ip/dhcp-server/lease/print'))->where('mac-address',$device->mac))->r();
                foreach($lease as $item){
                   $delobj=(object)$item;
                   $id=".id";
                   $link?->qr((new Query('/ip/dhcp-server/lease/remove'))->equal('.id',$delobj->$id));
                }
                $device->control_interface_id=null;
                $device->save();
            }
        }
    }
    public function deleted(InetDevices $device){
        dd($device);
    }
}
