<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\carbon;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        Category::whereNotNull('above_category')->delete();
        DB::table('categories')->delete();

        DB::table('categories')->insert([
            'name' => "Motoryzacja",
            'created_at' => $now,
            
        ]);

        DB::table('categories')->insert([
            'name' => "Elektronika",
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "Dom i ogród",
            'created_at' => $now,

        ]);

        DB::table('categories')->insert([
            'name' => "Nieruchomości",
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "Praca",
            'created_at' => $now,
        ]);

        $motoryzacja = Category::where('name', 'Motoryzacja')->first()->id;

        DB::table('categories')->insert([
            'name' => "Samochody osobowe",
            'above_category' => $motoryzacja,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "Samochody ciężarowe",
            'above_category' => $motoryzacja,
            'created_at' => $now,
        ]);


        DB::table('categories')->insert([
            'name' => "Części",
            'above_category' => $motoryzacja,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "Maszyny rolnicze",
            'above_category' => $motoryzacja,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "Motocykle",
            'above_category' => $motoryzacja,
            'created_at' => $now,
        ]);
    }

}