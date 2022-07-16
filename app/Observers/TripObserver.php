<?php

namespace App\Observers;


use App\Models\Trip;

class TripObserver
{

    /**
     * Handle the Trip "created" event.
     *
     * @param Trip $trip
     * @return void
     */
    public function created(Trip $trip)
    {
        //
    }

    /**
     * Handle the Trip "updated" event.
     *
     * @param Trip $trip
     * @return void
     */
    public function updated(Trip $trip)
    {
        if ($trip->isDirty('status') && $trip->status = 'delivered') {
            $trip->order->delivered_at = now();
            $trip->save();
        }
    }

}
