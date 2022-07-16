<?php

namespace Database\Factories;

use App\Models\DelayReport;
use Illuminate\Database\Eloquent\Factories\Factory;

class DelayReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\DelayReport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => rand(1,50),
            'status' => DelayReport::STATUSES[rand(0,1)]
        ];
    }
}

