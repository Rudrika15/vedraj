<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
}
