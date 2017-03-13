<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['firstname', 'lastname', 'pesel', 'birth_date', 'number_of_id_card',
		'telephone_number', 'email', 'password', 'place', 'avenue', 'house_number', 'apartment_number', 
		'post_code', 'client_status_id', 'kind_of_user_id', 'bank_account_number',
		];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public $edit_rules = [
			'firstname' => 'required|max:255',
			'lastname' => 'required|max:255',
			'pesel' => 'required|max:11|min:11',
			'birth_date' => 'required',
			'number_of_id_card' => 'required|max:20',
			'telephone_number' => 'max:11',

			'email' => 'required|email|max:255',
			'password' => 'confirmed|min:6',
			'place' => 'required',
			'house_number' => 'required',
			'post_code' => 'required',
		];


	
}
