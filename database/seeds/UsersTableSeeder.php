<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\ClientStatus;
use App\KindOfUser;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $birth_date = Carbon::createFromDate(1993, 10, 18);
        $birth_date2 = Carbon::createFromDate(1990, 11, 22);
        $client_status = ClientStatus::first();
        $admin = KindOfUser::first();
        $moderator = KindOfUser::where('name', 'Moderator')->first();
        $uzytkownik = KindOfUser::where('name', 'Użytkownik')->first();

        DB::table('users')->insert([
            'firstname' => "Tomek",
            'lastname' => "Grygiel",
            'pesel' => '83245713481', 
            'birth_date' => $birth_date,
            'number_of_id_card' => "AWE37126122",
            'telephone_number' => 832123452,
            'bank_account_number' => '89765646861198765678987654',
            'email' => "tomek@wp.pl",
            'password' => bcrypt('roman1'),
            'place' => "Szklana Huta",
            // 'avenue' => "",
            'house_number' => "17",
            // 'apartment_number' => "",
            'post_code' => "98-270 Złoczew",
            'client_status_id'=> $client_status->id,
            'kind_of_user_id' => $admin->id,
            
        ]);

       DB::table('users')->insert([
            'firstname' => "Adam",
            'lastname' => "Karzeł",
            'pesel' => '33245713481', 
            'birth_date' => $birth_date2,
            'number_of_id_card' => "ASE37126122",
            'telephone_number' => 793821882,
            'bank_account_number' => '12365646861198165678987654',
            'email' => "adam@wp.pl",
            'password' => bcrypt("roman1"),
            'place' => "Złoczew",
             'avenue' => "Parkowa",
            'house_number' => "22",
             //'apartment_number' =>"15",
            'post_code' => "98-270 Złoczew",
            'client_status_id'=> $client_status->id,
            'kind_of_user_id' => $moderator->id,
            
        ]);

       DB::table('users')->insert([
            'firstname' => "Krystyna",
            'lastname' => "Janda",
            'pesel' => '85346812381', 
            'birth_date' => $birth_date2,
            'number_of_id_card' => "EWF37126122",
            'telephone_number' => 942391239,
            'bank_account_number' => '89722646861198765678987654',
            'email' => "janda@wp.pl",
            'password' => bcrypt("roman1"),
            'place' => "Sieradz",
             'avenue' => "Burzenińska",
            'house_number' => "25",
            // 'apartment_number' =>"",
            'post_code' => "22-270 Sieradz",
            'client_status_id'=> $client_status->id,
            'kind_of_user_id' => $uzytkownik->id,
            
        ]);


       DB::table('users')->insert([
            'firstname' => "Jan",
            'lastname' => "Tomaszewski",
            'pesel' => '85346812381', 
            'birth_date' => $birth_date,
            'number_of_id_card' => "AFD21309",
            'telephone_number' => 948273123,
            'bank_account_number' => '19765646861198765678987654',
            'email' => "tomaszweski@wp.pl",
            'password' => bcrypt("roman1"),
            'place' => "Wieluń",
             'avenue' => "Mariańska",
            'house_number' => "25",
            // 'apartment_number' => "",
            'post_code' => "22-120 Wieluń",
            'client_status_id'=> $client_status->id,
            'kind_of_user_id' => $uzytkownik->id,
            
        ]);

    }

}