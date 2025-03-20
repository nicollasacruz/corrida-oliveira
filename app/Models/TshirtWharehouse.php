<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TshirtWharehouse extends Model
{
    protected $fillable = [
        'size',
        'quantity',
    ];

    public function tshirtMovements()
    {
        return $this->hasMany(TshirtMovement::class);
    }
}
