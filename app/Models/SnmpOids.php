<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SnmpOids extends Model
{
    use HasFactory;
    public function SnmpTemplate()
    {
        return $this->belongsTo(SnmpTemplate::class);
    }
}
