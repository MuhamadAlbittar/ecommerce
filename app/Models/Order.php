<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'status',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderVendors()
    {
        return $this->hasMany(OrderVendor::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'order_vendors');
    }

    public function payments()
    {
        return $this->hasMany(OrderPayment::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }
}