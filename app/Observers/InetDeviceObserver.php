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
           
            //REMOVE old address list ip            
            // $mk=$device->ControlInterface->Mikrotik;
             if($device->getOriginal('ip')!=null){
                $device->ControlInterface->Mikrotik->RemFromList($device->getOriginal('ip'));               
            }
            
            


            // $link= $device->ControlInterface->Mikrotik->Link;
           

            // $lease =$link?->q((new Query('/ip/dhcp-server/lease/print'))->where('mac-address',$device->mac))->r();
            // foreach($lease as $item){
            //     $delobj=(object)$item;
            //     $id=".id";
            //     $link?->qr((new Query('/ip/dhcp-server/lease/remove'))->equal('.id',$delobj->$id));
            //  }
            // if($device->billing_account_id!=null){
            //  $link?->qr((new Query('/ip/dhcp-server/lease/add'))->equal('address',$device->ip)->equal('mac-address',$device->mac)->equal('server',$device->ControlInterface->DhcpName)->equal('comment',$device->BillingAccount->ident));
            // }
            //add new lease
        }
        if($device->wasChanged('billing_account_id')){
            if($device->billing_account_id==null){               
                $device->ControlInterface->Mikrotik->RemLease($device->mac);
            }
        }
       
    }
    public function deleted(InetDevices $device){
        dd($device);
    }
    public function created(InetDevices $device)
    {

    }
}
