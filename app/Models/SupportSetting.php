<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportSetting extends Model
{
    protected $fillable = [
        'store_email',
        'store_phone',
        'store_address',
        'vendor_phone',
        'vendor_email',
        'seller_phone',
        'seller_email',
    ];
}

