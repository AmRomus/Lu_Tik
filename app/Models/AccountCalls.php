<?php

namespace App\Models;

use App\CallTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AccountCalls extends Model
{
    protected $casts=
    [
        'call_type'=>CallTypes::class,
    ];
    public function scopeActual(Builder $q)
    {
       $q->where('created_at','>',Carbon::now()->firstOfMonth());
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
