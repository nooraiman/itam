<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetHistory extends Model
{
    use HasFactory;

    protected  $fillable = [
        'asset_id',
        'status',
        'assigned_to',
        'assigned_by',
        'assigned_at',
        'returned_at',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
