<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
}
