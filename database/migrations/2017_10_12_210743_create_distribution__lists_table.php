<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_lists', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('trip_id')->nullable();
			$table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('package', 150)->nullable();
            $table->char('reocuring_payments', 1)->nullable();
            $table->char('paid_in_full', 1)->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('notes')->nullable();
            $table->string('user_updated', 50)->nullable();
            $table->timestamp('signup_date');
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
        Schema::dropIfExists('distribution__lists');
    }
}
