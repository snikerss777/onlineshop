<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdvertisementStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('advertisement_statuses')->delete();

        DB::table('advertisement_statuses')->insert([
            'name' => "Do akceptacji"
        ]);

        DB::table('advertisement_statuses')->insert([
            'name' => "Aktywne" 
        ]);

        DB::table('advertisement_statuses')->insert([
            'name' => "Odrzucone" 
        ]);

        DB::table('advertisement_statuses')->insert([
            'name' => "Wygasło",
        ]);

        DB::table('advertisement_statuses')->insert([
            'name' => "Zakończone",
        ]);

        DB::table('advertisement_statuses')->insert([
            'name' => "Usuniete",
        ]);

        

    }

}