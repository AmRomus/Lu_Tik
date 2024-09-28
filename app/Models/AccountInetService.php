<?php

namespace App\Models;


use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountInetService extends Model
{
    use HasFactory;
    public function MikroBillApi()
    {
        return $this->belongsTo(MikroBillApi::class);
    }
    public function scopeActive(Builder $query)
    {
        $query->whereNotNull('inet_service_id');
    }
    public function InetService()
    {
        return $this->belongsTo(InetService::class);
    }
    public function InetDevices()
    {
        return $this->hasMany(InetDevices::class);
    }
}
