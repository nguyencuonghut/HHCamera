<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceLog extends Model
{
    use HasFactory;

    protected $fillable = ['device_id', 'action', 'old_category_id', 'new_category_id', 'old_status', 'new_status'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function old_category()
    {
        return $this->belongsTo(DeviceCategory::class, 'old_category_id');
    }

    public function new_category()
    {
        return $this->belongsTo(DeviceCategory::class, 'new_category_id');
    }
}
