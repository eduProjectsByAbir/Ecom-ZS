<?php

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubcategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug');
            $table->foreignIdFor(Category::class, 'category_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SubCategory::class, 'sub_category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SubSubcategory::class, 'sub_subcategory_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('code');
            $table->string('qty')->default('0');
            $table->string('tags')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('price');
            $table->string('discount_price')->nullable();
            $table->string('short_description');
            $table->text('long_description')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->boolean('hot_deals')->default(false)->nullable();
            $table->boolean('featured')->default(false)->nullable();
            $table->boolean('special_offer')->default(false)->nullable();
            $table->boolean('special_deals')->default(false)->nullable();
            $table->boolean('status')->default(true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
