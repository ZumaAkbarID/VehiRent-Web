<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleSpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_specs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_type')->unsigned();
            $table->string('vehicle_name')->unique();
            $table->string('vehicle_image');
            $table->integer('vehicle_year');
            $table->string('vehicle_color');
            $table->integer('vehicle_seats');
            $table->enum('vehicle_status', ['Available', 'Not Available', 'On Repair']);
            $table->bigInteger('rent_price');
            $table->longText('vehicle_description');
            $table->timestamps();
        });

        Schema::table('vehicle_specs', function ($table) {
            $table->foreign('id_type')->references('id')->on('types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_specs');
    }
}