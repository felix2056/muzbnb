<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPayoutTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_payout', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('street_address');
            $table->string('locality');
            $table->string('region');
            $table->string('postal_code');
            $table->string('descriptor');
            $table->string('email');
            $table->string('mobile_phone');
            $table->string('account_number');
            $table->string('rounting_number');
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
        Schema::dropIfExists('user_payout');
    }
}
