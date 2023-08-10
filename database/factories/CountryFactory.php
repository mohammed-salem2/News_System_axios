<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return arrays
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->unique()->country(),
            'code'=>$this->faker->unique()->numberBetween(1,999),
        ];
    }
}
