<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserPaymentsAddNameFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('user_payment', function (Blueprint $table) {
        //     $table->string('first_name')->nullable();
        //     $table->string('last_name')->nullable();
        //     $table->integer('postal_code')->nullable();
        //     $table->string('country')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
