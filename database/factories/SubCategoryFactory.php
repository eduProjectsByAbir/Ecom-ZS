<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'category_id' => Category::inRandomOrder()->value('id'),
        ];
    }
}