<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    use HasFactory;

    protected $fillable = ['devicec_id','detection_time', 'recovery_time', 'cause', 'solution', 'type_id'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function type()
    {
        return $this->belongsTo(ErrorType::class);
    }
}
