<?php

namespace App\Models;

use App\Observers\InetDeviceObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
#[ObservedBy(InetDeviceObserver::class)]
class InetDevices extends Model
{
    use HasFactory;
    protected $fillable=[
        'mac',
    ];
    public function BillingAccount()
    {
        return $this->belongsTo(BillingAccount::class);
    }
    public function ControlInterface()
    {
        return $this->belongsTo(ControlInterface::class);
    }
   
    
}
