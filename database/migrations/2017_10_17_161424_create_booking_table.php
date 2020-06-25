<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('booking', function ($table) {
            $table->increments('id');
            $table->integer('guest_id');
            $table->integer('listing_id');
            $table->integer('host_id');
            $table->string('number_of_guest');
            $table->string('date_from');
            $table->string('date_to');
            $table->tinyInteger('status');
            $table->string('transaction_id')->default(0);
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
        //
        Schema::dropIfExists('booking');
    }
}
