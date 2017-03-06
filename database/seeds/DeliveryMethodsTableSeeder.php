<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DeliveryMethodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_methods')->delete();


        DB::table('delivery_methods')->insert([
            'name' => "Odbiór osobisty"
            
        ]);

        DB::table('delivery_methods')->insert([
            'name' => "Kurierem za pobraniem",
        ]);

        DB::table('delivery_methods')->insert([
            'name' => "Kurierem za przelew",
        ]);

        DB::table('delivery_methods')->insert([
            'name' => "Poczta",
        ]);


    }

}