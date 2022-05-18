<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookeds', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->bigInteger('id_rental')->unsigned();
            $table->bigInteger('id_vehicle')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->date('start_book_date');
            $table->date('end_book_date');
            $table->enum('status_book', ['Booked', 'Canceled', 'Expired']);
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
        Schema::dropIfExists('bookeds');
    }
}