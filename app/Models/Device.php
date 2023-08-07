<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'position', 'ipi', 'status', 'farm_id', 'device_category_id'];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function device_category()
    {
        return $this->belongsTo(DeviceCategory::class);
    }
}
