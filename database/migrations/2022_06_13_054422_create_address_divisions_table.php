<?php

use App\Models\AddressCountry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressDivisionsTable extends Migration
{
    public function up()
    {
        Schema::create('address_divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(AddressCountry::class, 'address_country_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('address_divisions');
    }
}
