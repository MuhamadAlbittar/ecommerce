<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    protected $table = 'shipping_methods';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function vendorShippingMethods()
    {
        return $this->hasMany(VendorShippingMethod::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_shipping_methods');
    }
}