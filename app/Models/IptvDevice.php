<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class IptvDevice extends Model
{
    public function getOnlineStatusAttribute()
    {  
        
        if($this->updated_at)      
            $to = Carbon::parse($this->updated_at);
        else
            $to = Carbon::parse('1970-01-01');
        $from = Carbon::now();    
        if($from->diffInMinutes($to,true)>2)
            return 0;
        else
            return 1;
    }
    public function BillingAccount()
    {
        return $this->belongsTo(BillingAccount::class);
    }
    public function IptvStreamStat()
    {
        return $this->hasMany(IptvStreamStat::class);
    }
}
