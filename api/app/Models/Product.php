<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "name",
        "slug",
        "short_info",
        "category_id",
        "subcategory_id",
        "price",
        "description",
        "in_stock",
        "visible",
    ];

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory ()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function photos () {
        return $this->hasMany(ProductPhoto::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
