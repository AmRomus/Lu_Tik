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
        'speed_up_unit',
        'speed_down',
        'speed_down_unit',
        'bust_percent',
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
