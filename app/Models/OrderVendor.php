<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderVendor extends Model
{
    protected $table = 'order_vendors';

    protected $fillable = [
        'order_id',
        'vendor_id',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}