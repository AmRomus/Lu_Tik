<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnmpTemplate extends Model
{
    public function Rels()
    {
        return $this->hasMany(SnmpTemplateRel::class,'snmp_template_id');
    }
    public function SnmpOids()
    {
        return $this->hasMany(SnmpOids::class);
    }
    public function SnmpSignals()
    {
        return $this->hasMany(SnmpSignals::class);
    }
}
