<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TshirtMovement extends Model
{
    protected $fillable = [
        'tshirt_wharehouse_id',
        'quantity',
        'type',
        'user_id',
    ];

    public function tshirtWharehouse(): BelongsTo
    {
        return $this->belongsTo(TshirtWharehouse::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
