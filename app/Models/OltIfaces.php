<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OltIfaces extends Model
{
    use HasFactory;
    public function Onu()
    {
        return $this->hasMany(Onu::class);
    }
}
