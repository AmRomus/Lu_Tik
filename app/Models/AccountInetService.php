<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountInetService extends Model
{
    use HasFactory;
    public function MikroBillApi()
    {
        return $this->belongsTo(MikroBillApi::class);
    }
}
