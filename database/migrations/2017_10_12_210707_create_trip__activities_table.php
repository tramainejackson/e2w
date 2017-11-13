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
            $table->integer('trip_id');
            $table->string('trip_event', 255);
            $table->string('activity_location', 50);
            $table->date('activity_date');
			$table->char('show_activity', 1);
            $table->string('user_updated', 50);
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
