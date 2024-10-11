<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InetService extends Model
{
    use HasFactory;
    protected $fillable=[
        'tarif_id',      
        'speed_up',
        'speed_down',
        'price',
    ];

    public function Tarif()
    {
        return $this->belongsTo(Tarif::class);
    }

    public function AccountInetService()
    {
        return $this->hasMany(AccountInetService::class);
    }

   
}
