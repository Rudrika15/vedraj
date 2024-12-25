<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
