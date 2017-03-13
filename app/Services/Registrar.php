<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use App\ClientStatus;
use App\KindOfUser;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'firstname' => 'required|max:255',
			'lastname' => 'required|max:255',
			'pesel' => 'required|max:11|min:11',
			'birth_date' => 'required',
			'number_of_id_card' => 'required|max:20',
			'telephone_number' => 'max:11',

			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'place' => 'required',
			'house_number' => 'required',
			'post_code' => 'required',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{	
		$client_status_id = ClientStatus::where('name', 'Aktywny')->first()->id;
		$kind_of_user = KindOfUser::where('name', 'Użytkownik')->first()->id;

		if ( array_key_exists('kind_of_user_id', $data) ){
			$kind_of_user = $data['kind_of_user_id'];
		}
		return User::create([
			'firstname' => $data['firstname'],
			'lastname' => $data['lastname'],
			'pesel' => $data['pesel'],
			'birth_date' => $data['birth_date'],
			'number_of_id_card' => $data['number_of_id_card'],
			'telephone_number' => $data['telephone_number'],
			'bank_account_number' => $data['bank_account_number'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'place' => $data['place'],
			'avenue' => $data['avenue'],
			'house_number' => $data['house_number'],
			'apartment_number' => $data['apartment_number'],
			'post_code' => $data['post_code'],
			'client_status_id' => $client_status_id,  
			'kind_of_user_id' => $kind_of_user,


		]);
	}

}
