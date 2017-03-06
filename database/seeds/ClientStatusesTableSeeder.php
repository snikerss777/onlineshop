<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('clients_statuses')->delete();

        DB::table('clients_statuses')->insert([
            'name' => "Aktywny"
            
        ]);

        DB::table('clients_statuses')->insert([
            'name' => "Ban",
            "ban_time" => 7,
        ]);

        DB::table('clients_statuses')->insert([
            'name' => "Ban",
            "ban_time" => 30,
        ]);

        DB::table('clients_statuses')->insert([
            'name' => "Ban",
            "ban_time" => 150,
        ]);

        DB::table('clients_statuses')->insert([
            'name' => "Usunięty",
        ]);
    }

}