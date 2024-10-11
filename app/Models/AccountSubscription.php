<?php

namespace App\Models;

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
}
