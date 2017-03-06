<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoneDeals extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('done_deals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('number_of_copies');
			$table->timestamps();
			$table->boolean('is_accepted');

			$table->integer('owner_id')->unsigned();
			$table->integer('buyer_id')->unsigned();
			$table->integer('advertisement_id')->unsigned();
			$table->integer('delivery_method_id')->unsigned();

			$table->foreign('owner_id')->references('id')->on('users');
			$table->foreign('buyer_id')->references('id')->on('users');
			$table->foreign('advertisement_id')->references('id')->on('advertisements');
			$table->foreign('delivery_method_id')->references('id')->on('delivery_methods');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('done_deals');
	}

}
