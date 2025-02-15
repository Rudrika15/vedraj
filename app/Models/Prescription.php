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

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    public function disease()
    {
        return $this->belongsTo(Disease::class, 'disease_id');
    }
}
