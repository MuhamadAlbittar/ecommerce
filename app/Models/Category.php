<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function productCategories()
    {
        return $this->hasMany(ProductCategory::class);
    }

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_categories');
    // }
public function products()
{
    return $this->hasMany(Product::class);
}
}
