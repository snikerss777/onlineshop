<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {

	protected $table = 'transactions';

	protected $fillable = ['buyer_id', 'delivery_method_id', 'transaction_status_id'];

}
