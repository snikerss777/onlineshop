<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementDeliveryMethods extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertisement_deleivery_methods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('advertisement_id')->unsigned();
			$table->integer('delivery_method_id')->unsigned();

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
		Schema::drop('advertisement_deleivery_methods');
	}

}
