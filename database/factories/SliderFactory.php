<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word();
        return [
            'title' => $name,
            'description' => $this->faker->unique()->sentence,
            'image' => $this->faker->imageUrl,
            'status' => true
        ];
    }
}
