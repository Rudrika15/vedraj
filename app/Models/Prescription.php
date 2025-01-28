<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function medicines()
    {
        return $this->hasMany(PrescriptionMedicine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
