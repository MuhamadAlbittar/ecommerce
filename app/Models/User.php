<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
    ];

    /* -------------------------
        Relationships
    --------------------------*/

    // User → UserAddresses (1:N)
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    // User → VendorUsers (1:N)
    public function vendorUsers()
    {
        return $this->hasMany(VendorUser::class);
    }

    // User → Vendors (N:N عبر vendor_users)
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_users');
    }

    // User → Orders (1:N)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // User → Carts (1:N)
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // User → Active Cart (1:1 مع شرط)
    public function activeCart()
    {
        return $this->hasOne(Cart::class)->where('status', 'active');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
