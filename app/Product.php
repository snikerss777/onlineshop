<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $fillable = ['id', 'advertisement_id', 'src', 'name', 'price', 'number_of_copies'];

}
