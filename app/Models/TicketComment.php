<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TicketComment extends Model
{
    public function getTimeLeftAttribute()
    {
        return Carbon::now()->diff(Carbon::parse($this->created_at))->forHumans();
    }
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
