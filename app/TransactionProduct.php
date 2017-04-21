<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model {

	protected $table = 'transaction_products';

	public $fillable = ['transaction_id', 'product_id', 'number_of_copies' ];

}
