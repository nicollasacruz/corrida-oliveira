<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RunnerKit extends Model
{
    protected $fillable = ['participant_id', 'size', 'status', 'deliveredDate'];

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class);
    }
}
