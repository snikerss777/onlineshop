<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

	protected $table = 'photos';

	protected $fillable = ['src', 'advertisement_id'];

}
