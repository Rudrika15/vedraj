<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserWisePermission extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
