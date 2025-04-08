<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'user_cv',
        'device_name',
        'token'
    ];
}
