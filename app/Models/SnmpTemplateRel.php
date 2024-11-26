<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SnmpTemplateRel extends Model
{
    public function SnmpTemplate()
    {
        return $this->belongsTo(SnmpTemplate::class);
    }
    public function SnmpOids()
    {
        return $this->hasMany(SnmpOids::class);
    }
    public function device()
    {
        return $this->morphTo();
    }
}
