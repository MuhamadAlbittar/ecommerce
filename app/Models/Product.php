<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'sku',
        'price',
        'status',
    ];
    
    protected $casts = [
    'attributes' => 'array',
    'images' => 'array',
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
