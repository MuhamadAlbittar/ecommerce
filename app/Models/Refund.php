<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refunds';

    protected $fillable = [
        'order_id',
        'user_id',
        'status',
        'refund_type',     // full / partial
        'total_amount',
        'notes',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function refundItems()
    {
        return $this->hasMany(RefundItem::class);
    }
}