<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class VendorUser extends Pivot
{
    protected $table = 'vendor_users';

    protected $fillable = [
        'vendor_id',
        'user_id',
        'role',
        'permissions',
        'added_by',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
