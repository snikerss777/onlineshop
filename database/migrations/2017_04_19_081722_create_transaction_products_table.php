<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transaction_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('transaction_id')->unsigned();
			$table->integer('product_id')->unsigned();
			$table->integer('number_of_copies');
			$table->timestamps();

			$table->foreign('transaction_id')->references('id')->on('transactions');
			$table->foreign('product_id')->references('id')->on('advertisements');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transaction_products');
	}

}
