<?php

namespace App\Models;

use App\Observers\InetDeviceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RouterOS\Query;
#[ObservedBy(InetDeviceObserver::class)]
class InetDevices extends Model
{
    use HasFactory;
    protected $fillable=[
        'mac',
    ];
    public function BillingAccount()
    {
        return $this->belongsTo(BillingAccount::class);
    }
    public function ControlInterface()
    {
        return $this->belongsTo(ControlInterface::class);
    }
   
    public function getInetSpeedLimitAttribute()
    {
        $inet_service=$this->BillingAccount?->Subscription?->tarif?->InetService;
        if ($inet_service){
            $up_speed= $inet_service->speed_up.$inet_service->speed_up_unit;
            $down_speed= $inet_service->speed_down.$inet_service->speed_down_unit; 
           
        }else {
            $inet_service=$this->BillingAccount->Tarif->InetService;
            $up_speed= $inet_service->speed_up.$inet_service->speed_up_unit;
            $down_speed= $inet_service->speed_down.$inet_service->speed_down_unit; 
        }
        $speeds=$up_speed.'/'.$down_speed;
        return $speeds;
    }

    public function getPingAttribute()
    {
       //(new Query('/ping')))->equal('address',$this->ip)->equal( 'count', '10')->r();
        $mq =(new Query('/ping'))->equal('address',$this->ip)->equal( 'count', '10');
      //  $ping_ret = $this->Mikrotik->API->qr($mq);  
      $ping_ret = $this->ControlInterface->Mikrotik->Link?->qr($mq); 
     // dd($ping_ret);
        return $ping_ret;
    }
    
}
