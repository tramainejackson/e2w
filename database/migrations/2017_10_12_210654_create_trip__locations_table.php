<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip__locations', function (Blueprint $table) {
            $table->increments('id');
			$table->string('trip_location', 50);
			$table->string('description', 350);
			$table->string('conditions', 1000);
			$table->string('cost', 1000);
			$table->string('payments', 1000);
			$table->string('inclusions', 1000);
			$table->string('trip_month', 15);
			$table->integer('trip_year');
			$table->string('trip_photo', 100);
			$table->string('flyer_name', 100);
			$table->char('trip_complete', 1);
			$table->char('show_trip', 1);
			$table->date('deposit_date');
			$table->date('due_date');
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
        Schema::dropIfExists('trip__locations');
    }
}
