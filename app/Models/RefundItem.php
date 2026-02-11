<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RefundItem extends Model
{
    protected $table = 'refund_items';

    protected $fillable = [
        'refund_id',
        'order_item_id',
        'quantity',
        'price_at_refund',
        'total_amount',
        'notes',
    ];

    public function refund()
    {
        return $this->belongsTo(Refund::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
}