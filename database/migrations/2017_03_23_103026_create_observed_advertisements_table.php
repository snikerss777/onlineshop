<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservedAdvertisementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('observed_advertisements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('advertisement_id')->unsigned();
			$table->timestamps();

			$table->foreign('advertisement_id')->references('id')->on('advertisements');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('observed_advertisements');
	}

}
