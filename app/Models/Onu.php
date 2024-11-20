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
        $olt=$this->OltIfaces->Olt;
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
                    return "No Signal";
                }
                return $ret->getValue();                
            }
        }
    }
    public function BillingAccount()
    {
        return $this->belongsTo(BillingAccount::class);
    }
}
