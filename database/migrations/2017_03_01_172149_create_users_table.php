<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('pesel');
			$table->date('birth_date');
			$table->string('number_of_id_card');
			$table->integer('telephone_number')->nullable();
			$table->string('bank_account_number')->nullable();

			$table->string('email')->unique();
			$table->string('password', 60);
			$table->string('place');
			$table->string('avenue')->nullable();
			$table->string('house_number');
			$table->string('apartment_number')->nullable();
			$table->string('post_code');
			$table->integer('client_status_id')->unsigned();
			$table->integer('kind_of_user_id')->unsigned();
			$table->rememberToken();
			$table->timestamps();

			$table->foreign('client_status_id')->references('id')->on('clients_statuses');
			$table->foreign('kind_of_user_id')->references('id')->on('kind_of_users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
