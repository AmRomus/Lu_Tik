<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OltIfaces extends Model
{
    use HasFactory;
    public function Onu()
    {
        return $this->hasMany(Onu::class);
    }
    public function Olt()
    {
        return $this->belongsTo(Olt::class);
    }
    public function getIsUpAttribute(): bool
    {
        $olt=$this->Olt;
        if($olt)
        {
            $oid=$olt->OltTemplate?->SnmpOids?->where('cmd','ifstate')->first()?->oid;
            if($oid){
               
                $oid=$oid.$this->if_index;
                try {
                $ret=$olt->Read()->getOid($oid);
                }
                catch (\Exception $ign)
                {
                    return false;
                }

                return ((string)$ret->getValue()==="1")?true:false;;                
            }
        }
        return false;
    }
}
