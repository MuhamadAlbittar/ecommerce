<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'country',
        'city',
        'street',
        'building',
        'notes',
        'is_default',
    ];

    /* -------------------------
        Relationships
    --------------------------*/

    // UserAddress → User (N:1)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}