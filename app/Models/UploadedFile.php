<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UploadedFile extends Model
{
    public function LinkedObject()
    {
        return $this->morphTo();
    }
}
