<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IptvStreams extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
       'stream_url',
       'tvg_id',
       'tvg_ico',
       'have_catchup',
       'catchup_server',
       'show_start',
       'show_stop',
       'is_ott',
    ];
    protected $casts = 
    [
        'have_catchup'=>"boolean",
        'is_ott'=>"boolean",
        'tvg_id'=>"string"
    ];

}
