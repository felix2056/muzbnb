<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAndUpdateListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    // Schema::table('listings', function (Blueprint $table) {
		   //  $table->tinyInteger('check_in_time_from')->nullable();
		   //  $table->tinyInteger('check_in_time_to')->nullable();
		   //  $table->tinyInteger('check_out_time_from')->nullable();
		   //  $table->tinyInteger('check_out_time_to')->nullable();
	    // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    // Schema::table('listings', function (Blueprint $table) {
		   //  $table->dropColumn('check_in_time_from');
		   //  $table->dropColumn('check_in_time_to');
		   //  $table->dropColumn('check_out_time_from');
		   //  $table->dropColumn('check_out_time_to');
	    // });
    }
}
