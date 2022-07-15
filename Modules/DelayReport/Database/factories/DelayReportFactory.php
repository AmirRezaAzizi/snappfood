<?php

namespace Modules\DelayReport\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\DelayReport\Entities\DelayReport;

class DelayReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\DelayReport\Entities\DelayReport::class;

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

