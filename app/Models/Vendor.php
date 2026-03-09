<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vendor extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
    ];
    public function users()
    {
        return $this->belongsToMany(User::class, 'vendor_users')
        ->withPivot(['role','permissions'])
        ->withTimestamps();
    }

    public function vendorUsers()
    {
        return $this->hasMany(VendorUser::class);
    }

    public function vendorProducts()
    {
        return $this->hasMany(VendorProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'vendor_products');
    }

    public function orderVendors()
    {
        return $this->hasMany(OrderVendor::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_vendors');
    }

    public function vendorShippingMethods()
    {
        return $this->hasMany(VendorShippingMethod::class);
    }

    public function shippingMethods()
    {
        return $this->belongsToMany(ShippingMethod::class, 'vendor_shipping_methods');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('logo')->useDisk('public');
    }
}
