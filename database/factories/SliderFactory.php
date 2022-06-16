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
        $name = $this->faker->unique()->word(4);
        return [
            'title' => $name,
            'subtitle' => $this->faker->unique()->word(3),
            'description' => $this->faker->unique()->sentence,
            'button_text' => 'Shop Now',
            'button_link' => 'https://asliabir.github.io',
            'image' => $this->faker->imageUrl,
            'status' => true
        ];
    }
}
