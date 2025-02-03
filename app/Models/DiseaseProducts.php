<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiseaseProducts extends Model
{
    public function diseases()
    {
        return $this->hasOne(Disease::class, 'id', 'disease_id');
    }
}
