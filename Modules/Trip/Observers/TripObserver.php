<?php

namespace Modules\Trip\Observers;


use Modules\Trip\Entities\Trip;

class TripObserver
{
    /**
     * Handle the Trip "creating" event.
     *
     * @param Trip $trip
     * @return void
     */
    public function creating(Trip $trip)
    {
        $trip->last_status_time = now();
    }
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
    public function updating(Trip $trip)
    {
        if ($trip->isDirty('status')) {
            $trip->last_status_time = now();
        }
    }

    /**
     * Handle the Trip "updated" event.
     *
     * @param Trip $trip
     * @return void
     */
    public function updated(Trip $trip)
    {
        //
    }

}
