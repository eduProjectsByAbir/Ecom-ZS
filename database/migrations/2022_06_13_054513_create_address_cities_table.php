<?php

use App\Models\AddressDistrict;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressCitiesTable extends Migration
{
    public function up()
    {
        Schema::create('address_cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(AddressDistrict::class, 'address_district_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('address_cities');
    }
}
