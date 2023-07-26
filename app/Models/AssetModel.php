<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetModel extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'number',
        'category_id',
        'manufacturer_id'
    ];

    // Return this item's category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Return this item's manufacturer
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    // Return all assets for this item
    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
