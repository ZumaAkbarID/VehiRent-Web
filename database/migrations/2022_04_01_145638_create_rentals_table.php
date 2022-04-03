<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('rent_name');
            $table->bigInteger('id_vehicle')->unsigned();
            $table->dateTime('start_rent_date');
            $table->dateTime('end_rent_date');
            $table->string('guarante_rent_1');
            $table->string('guarante_rent_2')->nullable();
            $table->string('guarante_rent_3')->nullable();
            $table->bigInteger('rent_price');
            $table->timestamps();
        });

        Schema::table('rentals', function ($table) {
            $table->foreign('id_vehicle')->references('id')->on('vehicle_specs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}