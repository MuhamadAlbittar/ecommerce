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
        'product_id',
        'sku',
        'vendor',
        'description',
        'image',
        'price',
        'sale_price',
        'category_id',
        'tags',
        'status',
    ];

    // ========= العلاقات الجديدة (بدلاً من القديمة) =========

    // علاقة مع التصنيف (واحد)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // علاقة مع البائعين (many-to-many) تبقى كما هي
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_products');
    }

    // علاقة مع عناصر الطلب
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // علاقة مع مرتجعات
    public function refundItems()
    {
        return $this->hasMany(RefundItem::class);
    }

    // إذا كنت تحتاج دوال أخرى مثل vendorProducts، يمكنك الاحتفاظ بها
    public function vendorProducts()
    {
        return $this->hasMany(VendorProduct::class);
    }

    // ملاحظة: تم إزالة العلاقات many-to-many مع categories والوسيط productCategories
}
