<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservedAdvertisement extends Model {

	protected $table = 'observed_advertisements';

	protected $fillable = ['advertisement_id', 'user_id'];

}
