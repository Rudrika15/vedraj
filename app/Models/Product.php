<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
    public function diseaseProducts()
    {
        return $this->hasMany(DiseaseProducts::class);
    }
}
