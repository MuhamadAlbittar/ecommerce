<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Category extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories');
    }
}
