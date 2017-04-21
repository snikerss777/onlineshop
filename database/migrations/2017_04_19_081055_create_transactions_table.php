<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('buyer_id')->unsigned();
			$table->integer('delivery_method_id')->unsigned();
			$table->integer('transaction_status_id')->unsigned();

			$table->timestamps();

			$table->foreign('buyer_id')->references('id')->on('users');
			$table->foreign('delivery_method_id')->references('id')->on('delivery_methods');
			$table->foreign('transaction_status_id')->references('id')->on('transaction_statuses');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transactions');
	}

}
