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
			$table->string('trip_location', 50)->nullable();
			$table->string('description', 350)->nullable();
			$table->string('conditions', 2500)->nullable();
			$table->string('cost', 2500)->nullable();
			$table->string('payments', 2500)->nullable();
			$table->string('inclusions', 2500)->nullable();
			$table->integer('trip_month')->nullable();
			$table->year('trip_year')->nullable();
			$table->string('trip_photo', 100)->nullable();
			$table->string('flyer_name', 100)->nullable();
			$table->char('trip_complete', 1)->nullable();
			$table->char('show_trip', 1)->nullable();
			$table->date('deposit_date')->nullable();
			$table->date('due_date')->nullable();
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
