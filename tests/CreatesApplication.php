<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Modules\Order\Entities\Order;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function createOrderAndTrip($deliveryTime, $tripStatus)
    {
        $order = Order::factory()->create([
            'delivery_time' => $deliveryTime
        ]);

        $order->trip()->create([
            'status' => $tripStatus
        ]);

        return $order;

    }
}
