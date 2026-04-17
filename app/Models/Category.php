<?php

namespace App\Models;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use InteractsWithMedia;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
        'image',
        'approval_status',
        'added_by',
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
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

   public function scopeForUser($query)
    {
        $user = auth()->user();
        if ($user->role === 'admin') {
        return $query; // admin sees all categories
         }

        return $query->where(function ($q) use ($user) {
        $q->where('added_by', $user->id)

        // and if it's approved or it's created by an admin
        ->orWhere(function ($sub) {
            $sub->where('approval_status', 'approved')
                ->whereHas('creator', fn($c) => $c->where('role', 'admin'));
        })

        // or if it's approved and not created by the current user
        ->orWhere(function ($sub) use ($user) {
            $sub->where('approval_status', 'approved')
                ->where('added_by', '!=', $user->id);
        });

    });
    }
}
