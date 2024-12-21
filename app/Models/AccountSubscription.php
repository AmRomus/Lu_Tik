<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountSubscription extends Model
{
    use HasFactory;
    public function Tarif(){
        return $this->belongsTo(Tarif::class);
    }

    public function getInetDevicesAttribute(){
        //($this->tarif->InetService)
    }
    public function scopeActive($q)
    {
        return $q->whereDate('acct_end','>',Carbon::now());
    }
}
