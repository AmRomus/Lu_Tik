<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcctionsHistory extends Model
{
    public function AcctObject()
    {
        return $this->morphTo();
    }
}
