<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use RouterOS\Query;

class ControlInterface extends Model
{
    use HasFactory;
    protected $fillable=[
        'ident',
        'interface'
    ];
    public function Mikrotik()
    {
        return $this->belongsTo(Mikrotik::class);
    }
    public function getIpAttribute()
    {
       return $this->Mikrotik->Link?->q((new Query('/ip/address/print'))->where('interface',$this->interface))->r();
    }
}
