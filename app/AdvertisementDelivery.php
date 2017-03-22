<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertisementDelivery extends Model {

	protected $table = 'advertisement_deleivery_methods'; 

	protected $fillable = ['advertisement_id', 'delivery_method_id'];

	public $timestamps = false;

}
