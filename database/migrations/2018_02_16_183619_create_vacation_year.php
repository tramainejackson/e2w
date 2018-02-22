<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacationYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacation_month', function (Blueprint $table) {
            $table->increments('year_id');
            $table->year('year_num')->nullable();
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
    }
	
	/** Init Insert Table
		INSERT INTO `vacation_year` (`year_id`, `year_num`) VALUES
		(1, '2005'),
		(2, '2006'),
		(3, '2007'),
		(4, '2008'),
		(5, '2009'),
		(6, '2010'),
		(7, '2011'),
		(8, '2012'),
		(9, '2013'),
		(10, '2014'),
		(11, '2015'),
		(12, '2016'),
		(13, '2017'),
		(14, '2018'),
		(15, '2019'),
		(16, '2020'),
		(17, '2021'),
		(18, '2022');
	**/
}
