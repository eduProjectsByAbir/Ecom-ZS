<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Brand::factory(15)->create();
        \App\Models\Category::factory(15)->create();
        \App\Models\SubCategory::factory(15)->create();
        \App\Models\SubSubcategory::factory(15)->create();
        \App\Models\Product::factory(500)->create();
        \App\Models\ProductImage::factory(1000)->create();
        // \App\Models\Admin::factory()->create();

        $this->call([
            RolePermissionSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
