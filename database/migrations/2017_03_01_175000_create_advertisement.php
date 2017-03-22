<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisement extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertisements', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 70);
			$table->text('description');
			$table->integer('price')->unsigned();
			$table->integer('number_of_copies');
			$table->date('end_date');
			$table->string('account_number');
			$table->string('place');
			$table->integer('create_year');
			$table->boolean('used');

			$table->integer('owner_id')->unsigned();
			$table->integer('category_id')->unsigned();
			$table->integer('advertisement_status_id')->unsigned();
			$table->integer('photo_id')->nullable();

			$table->timestamps();

			$table->foreign('owner_id')->references('id')->on('users');
			$table->foreign('category_id')->references('id')->on('categories');
			$table->foreign('advertisement_status_id')->references('id')->on('advertisement_statuses');
			$table->foreign('photo_id')->references('id')->on('photos');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('advertisements');
	}

}
