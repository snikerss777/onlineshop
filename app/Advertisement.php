<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

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
	protected $fillable = ['name', 'description', 'price', 'number_of_copies',
		'owner_id', 'category_id', 'advertisement_status_id', 'created_at', 'updated_at'] ;

	//TODO
	public $rules = [
			 'name' => 'required|max:255',
			'description' => 'required',
			'price' => 'required',
			'number_of_copies' => 'required',
			
			'category_id' => 'required',
			'deliveryMethods' => 'required|min:1',
		];

	
}
 