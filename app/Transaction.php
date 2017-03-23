<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

	protected $table = 'done_deals';

	protected $fillable = ['number_of_copies', 'is_accepted', 'owner_id', 'buyer_id', 'advertisement_id', 'delivery_method_id'];

}
