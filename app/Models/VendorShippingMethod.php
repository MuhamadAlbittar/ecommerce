<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorShippingMethod extends Model
{
    protected $table = 'vendor_shipping_methods';

    protected $fillable = [
        'vendor_id',
        'shipping_method_id',
        'price',
        'status',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class);
    }
}