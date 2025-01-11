<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AcctionsHistory extends Model
{
    public function AcctObject()
    {
        return $this->morphTo();
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at);
    }
}
