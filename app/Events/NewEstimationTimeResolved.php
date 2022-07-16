<?php


namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewEstimationTimeResolved
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * NewEstimationTimeResolved constructor.
     * @param $orderId
     * @param $time
     */
    public function __construct(public $orderId, public $time)
    {
        //
    }


}
