<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $deliveredRand = [now()->addMinutes(rand(60,120)), null];
        return [
            'vendor_id' => rand(1,10),
            'delivery_time' => now()->addMinutes(rand(-30,60)),
            'delivered_at' => $deliveredRand[array_rand($deliveredRand)],
        ];
    }
}

