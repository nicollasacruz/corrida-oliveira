<?php

namespace App\Observers;

use App\Models\RunnerKit;
use App\Models\TshirtWharehouse;
use Log;

class RunnerKitObserver
{
    /**
     * Handle the RunnerKit "created" event.
     */
    public function created(RunnerKit $runnerKit): void
    {
        //
    }

    /**
     * Handle the RunnerKit "updated" event.
     */
    public function updated(RunnerKit $runnerKit): void
    {
        Log::info("Entrei no updated");
        Log::info($runnerKit);
        if ($runnerKit->wasChanged('status') && $runnerKit->status === 'delivered') {
            $warehouse = TshirtWharehouse::where('size', $runnerKit->size)->first();
            if ($warehouse) {
                $warehouse->tshirtMovements()->create([
                    'user_id' => \Auth::user()->id,
                    'size' => $runnerKit->size,
                    'type' => 'output',
                ]);
                $warehouse->decrement('quantity');
                $warehouse->save();
            } else {
                Log::info("Warehouse not found for size {$runnerKit->size}");
            }
        } else {
            Log::info("RunnerKit status was not changed to delivered");
        }
    }

    /**
     * Handle the RunnerKit "deleted" event.
     */
    public function deleted(RunnerKit $runnerKit): void
    {
        //
    }

    /**
     * Handle the RunnerKit "restored" event.
     */
    public function restored(RunnerKit $runnerKit): void
    {
        //
    }

    /**
     * Handle the RunnerKit "force deleted" event.
     */
    public function forceDeleted(RunnerKit $runnerKit): void
    {
        //
    }
}
