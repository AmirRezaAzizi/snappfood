<?php

namespace Modules\Trip\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Trip\Entities\Trip;

class TripFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Trip\Entities\Trip::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => Trip::STATUSES[rand(0,3)],
            'order_id' => rand(1,50),
            'last_status_time' => now()->addMinutes(rand(0, 120)),
        ];
    }
}

