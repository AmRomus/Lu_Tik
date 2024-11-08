<?php

namespace App\Models;

use App\Observers\InetServiceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([InetServiceObserver::class])]
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
        'burst_time',
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
