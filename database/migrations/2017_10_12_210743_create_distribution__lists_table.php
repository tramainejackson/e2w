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
        Schema::create('distribution__lists', function (Blueprint $table) {
            $table->increments('id');
			$table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email', 100);
            $table->string('package', 150);
            $table->char('reocuring_payments', 1);
            $table->char('paid_in_full', 1);
            $table->string('phone', 15);
            $table->string('notes', 255);
            $table->string('user_updated', 50);
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
