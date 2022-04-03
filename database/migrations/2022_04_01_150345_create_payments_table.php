<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_code')->unique();
            $table->bigInteger('id_rental')->unsigned();
            $table->string('cashier');
            $table->string('payment_type');
            $table->dateTime('paid_date');
            $table->string('payer_name');
            $table->string('bank');
            $table->string('no_rek');
            $table->bigInteger('paid_total');
            $table->timestamps();
        });

        Schema::table('payments', function ($table) {
            $table->foreign('id_rental')->references('id')->on('rentals')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}