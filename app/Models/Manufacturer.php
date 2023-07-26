<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;

    protected  $fillable = [
        'name',
        'website',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
