<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use database\seeds\ClientStatusesTableSeeder;
use database\seeds\KindOfUsersTableSeeder;
use database\seeds\UsersTableSeeder;
use database\seeds\CategoriesTableSeeder;
use database\seeds\AdvertisementStatusesTableSeeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('ClientStatusesTableSeeder');
		$this->call('KindOfUsersTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('CategoriesTableSeeder');
		$this->call('AdvertisementStatusesTableSeeder');

	}

}
