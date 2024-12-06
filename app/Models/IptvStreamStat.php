<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IptvStreamStat extends Model
{
    public function IptvStream()
    {
        return $this->belongsTo(IptvStreams::class);
    }
}
