<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Agent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->name()
        ];
    }
}

