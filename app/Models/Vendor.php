<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
    ];

    public function vendorUsers()
    {
        return $this->hasMany(VendorUser::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'vendor_users');
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
}