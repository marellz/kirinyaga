<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        "name",
        "slug",
        "category_id",
        "description",
    ];

    public function products ()
    {
        return $this->hasMany(Product::class);
    }

    public function category ()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}
