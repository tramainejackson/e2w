<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip__activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id')->nullable();
            $table->string('trip_event', 255)->nullable();
            $table->string('activity_location', 50)->nullable();
            $table->date('activity_date')->nullable();
			$table->char('show_activity', 1)->nullable();
            $table->string('user_updated', 50)->nullable();
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
        Schema::dropIfExists('trip__activities');
    }
}
