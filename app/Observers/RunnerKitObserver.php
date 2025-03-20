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
        Log::info("Entrei no created");
    }

    /**
     * Handle the RunnerKit "updated" event.
     */
    public function updated(RunnerKit $runnerKit): void
    {

        if ($runnerKit->wasChanged('status') && $runnerKit->status === 'delivered') {
            $warehouse = TshirtWharehouse::where('size', $runnerKit->size)->first();
            if ($warehouse) {
                $warehouse->tshirtMovements()->create([
                    'user_id' => \Auth::user()->id,
                    'size' => $runnerKit->size,
                    'quantity' => 1,
                    'type' => 'output',
                ]);
                $warehouse->decrement('quantity');
                $warehouse->save();
                Log::info("Kit do corredor {$runnerKit->participant->fullName} foi entregue");
            } else {
                Log::info("Warehouse not found for size {$runnerKit->size}");
            }
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
