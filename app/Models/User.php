<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'country',
        'city',
        'street',
        'building',
        'created_by',
    ];

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

    /* -------------------------
        Media Library Config
    --------------------------*/
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('user-image')->useDisk('public')->singleFile();
    }

    /* -------------------------
        Relationships
    --------------------------*/

    // علاقة: المستخدم لديه عناوين متعددة
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    // علاقة: المستخدم لديه طلبات متعددة
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // علاقة: المستخدم قد يكون بائعاً (صاحب متجر)
    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    // علاقة: المستخدم ينتمي لعدة متاجر (كموظف أو مدير) - عبر جدول vendor_users
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_users')
            ->using(VendorUser::class)
            ->withPivot('role', 'permissions')
            ->withTimestamps();
    }

    // علاقة: سلة التسوق النشطة للمستخدم (يستحسن استخدامها في الكود)
    public function cart()
    {
        // نجلب السلة التي حالتها نشطة، أو أحدث سلة
        return $this->hasOne(Cart::class)->where('status', 'active')->latest();
    }

    // علاقة: جميع سلات المستخدم (للتاريخ)
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // لمعرفة من أضاف المستخدم (المستخدم الأب)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // المستخدمين الذين أضافهم هذا المستخدم (المستخدمين الأبناء)
    public function createdUsers()
    {
        return $this->hasMany(User::class, 'created_by');
    }
}
