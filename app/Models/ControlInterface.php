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
    public function InetDevices()
    {
        return $this->hasMany(InetDevices::class);
    }
    public function getDhcpNameAttribute()
    {
        $name="all";
        $ret = $this->Mikrotik->Link?->q((new Query('/ip/dhcp-server/print'))->where('interface',$this->interface))->r();
        foreach($ret as $item){
            $name=((object)$item)->name;
        }
        return $name;
    }
}
