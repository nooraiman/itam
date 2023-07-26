<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $nullable = [
        'assigned_to',
    ];

    protected  $fillable = [
        'name',
        'tag', 
        'serial_number',
        'model_id',
        'status',
    ];

    public function assetModel()
    {
        return $this->belongsTo(AssetModel::class, 'model_id');
    }

    public function assetHistory()
    {
        return $this->hasMany(AssetHistory::class);
    }


    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    public function getStatus()
    {
        $status = '';
        if($this->status == '1')
            $status = 'Available';
        else if($this->status == '2')
            $status ='Assigned';
        else if($this->status == '3')
            $status ='Maintenance';
        else if($this->status == '4')
            $status = 'Defective';
        else
            $status = 'Retired';

        return $status;
    }
}
