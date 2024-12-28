<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountNotes extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
