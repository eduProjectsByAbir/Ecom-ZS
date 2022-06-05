<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'brand_id' => Brand::inRandomOrder()->value('id'),
            'category_id' => Category::inRandomOrder()->value('id'),
            'sub_category_id' => SubCategory::inRandomOrder()->value('id'),
            'sub_subcategory_id' => SubSubcategory::inRandomOrder()->value('id'),
            'code' => $this->faker->unique()->text(10),
            'qty' => rand(0, 1000),
            'tags' => Arr::random(['car', 'food', 'water', 'milk', 'cream', 'banana', 'apple']),
            'size' => Arr::random(['S', 'M', 'L', 'XL', 'XXL', 'SM', 'MS']),
            'color' => Arr::random(['red', 'green', 'black', 'white', 'pink', 'yellow', 'skyblue']),
            'price' => rand(5, 1000),
            'short_description' => $this->faker->text,
            'long_description' => $this->faker->paragraph,
            'product_thumbnail' => $this->faker->imageUrl,
            'hot_deals' => rand(0,1),
            'featured' => rand(0,1),
        ];
    }
}
