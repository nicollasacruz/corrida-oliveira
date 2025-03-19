<?php

namespace App\Models;

use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'startDate', 'endDate', 'location', 'description', 'subscriptionFee', 'isChildEvent', 'image'];

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function runnerKits(): HasMany
    {
        return $this->hasMany(RunnerKit::class);
    }
}
