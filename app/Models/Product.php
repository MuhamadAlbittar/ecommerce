<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'sku',
        'price',
        'status',
    ];

    public function vendorProducts()
    {
        return $this->hasMany(VendorProduct::class);
    }

    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_products');
    }

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function refundItems()
    {
        return $this->hasMany(RefundItem::class);
    }
}