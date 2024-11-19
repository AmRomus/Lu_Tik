<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Onu extends Model
{
    use HasFactory;
    public function OltIface()
    {
        return $this->belongsTo(OltIfaces::class);
    }
}
