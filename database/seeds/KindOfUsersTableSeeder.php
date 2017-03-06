<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KindOfUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kind_of_users')->delete();


        DB::table('kind_of_users')->insert([
            'name' => "Admin"
            
        ]);

        DB::table('kind_of_users')->insert([
            'name' => "Moderator",
        ]);

        DB::table('kind_of_users')->insert([
            'name' => "Użytkownik",
        ]);

    }

}