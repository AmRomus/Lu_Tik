<?php

namespace App\Models;

use FreeDSx\Snmp\SnmpClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olt extends Model
{
    use HasFactory;
    public function OltTemplate(){
        return $this->belongsTo(OltTemplate::class);
    }

    public function Read()
    {        
        $snmp = new SnmpClient([
            'host' => $this->ip,
            'version' => 2,
            'community' => $this->ro_community,
        ]);
        return $snmp;
    }
    public function Write() 
    {
        $snmp = new SnmpClient([
            'host' => $this->ip,
            'version' => 2,
            'community' => $this->rw_community,
        ]);
        return $snmp;
    } 
}
