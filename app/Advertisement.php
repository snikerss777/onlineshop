<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'advertisements';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'description', 'price', 'number_of_copies', 'end_date', 'account_number',
		'place', 'create_year', 'used', 'owner_id', 'category_id', 'advertisement_status_id', 'created_at', 'updated_at'] ;

}
 