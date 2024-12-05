<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    public function channels()
    {        
       return $this->belongsToMany(IptvStreams::class)->withPivot(['id','order_id'])->orderByPivot('order_id');
    }
}
