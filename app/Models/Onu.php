<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onu extends Model
{
    use HasFactory;
    public function OltIfaces()
    {
        return $this->belongsTo(OltIfaces::class);
    }
    public function getSignalAttribute()
    {
        $olt=$this->OltIfaces?->Olt;
        if($olt)
        {
            $oid=$olt->OltTemplate?->SnmpOids?->where('cmd','onu_signal')->first()?->oid;
            if($oid){
               
                $oid=$oid.".".$this->OltIfaces->pon_index.$this->onu_index;
                try {
                $ret=$olt->Read()->getOid($oid);
                }
                catch (\Exception $ign)
                {
                    $this->online=false;
                    $this->save();
                    $this->fresh();
                    return "No Signal";
                }
                $this->online=true;
                $this->save();
                return $ret->getValue();                
            }
        }
    }
    public function BillingAccount()
    {
        return $this->belongsTo(BillingAccount::class);
    }
    
    public function getCatvAccessAttribute()
    {
        if(!$this->BillingAccount)
        {
            return 0;
        }       
        $Subscribtion=$this->BillingAccount->Subscriptions->first();
        if($Subscribtion)
        {
            if($Subscribtion->tarif->CatvService){
                return -1;
            }
        }else {
            if($this->BillingAccount->Tarif->CatvService){
                return $this->BillingAccount->Access;
            }
        }
        return 0;
    }
    public function getCatvBillingStateAttribute()
    {
        $service=$this->BillingAccount->Tarif->CatvService;
        return $service;
    }
    public function CatvOn()
    {
        $olt=$this->OltIfaces?->Olt;
        if($olt)
        {
            $oid=$olt->OltTemplate?->SnmpOids?->where('cmd','onu_catv')->first()?->oid;
            if($oid){               
                $oid=$oid.".".$this->OltIfaces->pon_index.$this->onu_index;         
                $olt->Write($oid,"i", 1);                  
            }
        }
    }
    public function reboot()
    {
        $olt=$this->OltIfaces->Olt;
        if($olt)
        {
            $oid=$olt->OltTemplate?->SnmpOids?->where('cmd','onu_reboot')->first()?->oid;
            if($oid){               
                $oid=$oid.".".$this->OltIfaces->pon_index.$this->onu_index;         
                $olt->Write($oid,"i", 1);                  
            }
        }
    }
}
