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


        $samochody_osobowe = Category::where('name', 'Samochody osobowe')->first()->id;

        DB::table('categories')->insert([
            'name' => "BMW",
            'above_category' => $samochody_osobowe,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "Audi",
            'above_category' => $samochody_osobowe,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "Peugeot",
            'above_category' => $samochody_osobowe,
            'created_at' => $now,
        ]);


        $bmw = Category::where('name', 'BMW')->first()->id;

        DB::table('categories')->insert([
            'name' => "Seria 3",
            'above_category' => $bmw,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "Seria 5",
            'above_category' => $bmw,
            'created_at' => $now,
        ]);


        DB::table('categories')->insert([
            'name' => "Seria 6",
            'above_category' => $bmw,
            'created_at' => $now,
        ]);


        DB::table('categories')->insert([
            'name' => "Seria 7",
            'above_category' => $bmw,
            'created_at' => $now,
        ]);

        $seria3 = Category::where('name', 'Seria 3')->first()->id;
        
        DB::table('categories')->insert([
            'name' => "e36",
            'above_category' => $seria3,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => "e46",
            'above_category' => $seria3,
            'created_at' => $now,
        ]);


        $motocykle = Category::where('name', 'Motocykle')->first()->id;

        DB::table('categories')->insert([
            'name' => 'Suzuki',
            'above_category' => $motocykle,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => 'Kawasaki',
            'above_category' => $motocykle,
            'created_at' => $now,
        ]);

        $elektronika = Category::where('name', 'Elektronika')->first()->id;

        DB::table('categories')->insert([
            'name' => 'Komputery',
            'above_category' => $elektronika,
            'created_at' => $now,
        ]);

        DB::table('categories')->insert([
            'name' => 'Telewizory',
            'above_category' => $elektronika,
            'created_at' => $now,
        ]);

    }

}