<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Transaction;
use App\Advertisement;
use App\User;
use Carbon;
use App\AdvertisementDelivery;
use Auth;
use App\DeliveryMethod;
use App\TransactionProduct;


class TransactionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	public function userTransactions($id)
	{
		$products = Transaction::join('transaction_products', 'transaction_products.transaction_id', '=', 'transactions.id')
			->join('advertisements', 'advertisements.id', '=' ,'transaction_products.product_id')
			->join('transaction_statuses', 'transaction_statuses.id', '=', 'transactions.transaction_status_id')
			->join('delivery_methods', 'delivery_methods.id', '=', 'transactions.delivery_method_id')
			->where('buyer_id', $id)
			->where('transaction_status_id', '!=' , 5)
			->groupBy('transactions.id')
			->select('transactions.created_at', \DB::Raw('sum(transaction_products.number_of_copies) as number_of_products') ,\DB::Raw('sum(transaction_products.number_of_copies * advertisements.price) as total_cost'), 
				 'transactions.id as id', 'transaction_statuses.name as status', 'delivery_methods.name as delivery_name',
				'delivery_methods.cost as delivery_cost')
			->get();

		return view('transaction.userTransactions', compact('products'));
	}

	public function userProducts($id)
	{
		$products = TransactionProduct::join('transactions', 'transactions.id', '=', 'transaction_products.transaction_id')
			->join('advertisements', 'advertisements.id', '=' ,'transaction_products.product_id')
			->leftjoin('photos', 'photos.id', '=', 'advertisements.photo_id')
			->where('buyer_id', $id)
			->where('transaction_status_id', '!=' , 5)
			//->where('transaction_status_id', 3)
			->select('advertisements.name', 'transaction_products.number_of_copies', 'photos.icon_src', 'transactions.created_at', 'advertisements.price', 'advertisements.id as advertisement_id')
			->get();

		return view('transaction.userProducts', compact('products'));
	}


	public function adminTransactions()
	{
		$products = Transaction::join('transaction_products', 'transaction_products.transaction_id', '=', 'transactions.id')
			->join('advertisements', 'advertisements.id', '=' ,'transaction_products.product_id')
			->join('transaction_statuses', 'transaction_statuses.id', '=', 'transactions.transaction_status_id')
			->join('delivery_methods', 'delivery_methods.id', '=', 'transactions.delivery_method_id')
			->where('transaction_status_id', '=' , 1)
			->orWhere('transaction_status_id', '=' , 2)
			
			->groupBy('transactions.id')
			->select('transactions.created_at', \DB::Raw('sum(transaction_products.number_of_copies) as number_of_products') ,\DB::Raw('sum(transaction_products.number_of_copies * advertisements.price) as total_cost'), 
				 'transactions.id as id', 'transaction_statuses.name as status', 'delivery_methods.name as delivery_name',
				'delivery_methods.cost as delivery_cost')
			->get();

			return view('transaction.adminTransactions', compact('products'));
	}

	public function changeStatus($id, $statusId)
	{
		$transaction = Transaction::findOrFail($id);
		$transaction->transaction_status_id = $statusId;
		$transaction->save();

		return redirect('/admin/transactions')->with('positive_message', 'Status transakcji o numerze: '.$id.' został zmieniony.');

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	// public function create($id)
	// {
	// 	$advertisement = Advertisement::findOrFail($id);
	// 	$owner = User::findOrFail($advertisement->owner_id);
	// 	$deliveryMethods = AdvertisementDelivery::join('delivery_methods', 'delivery_methods.id', '=', 'advertisement_deleivery_methods.delivery_method_id')
	// 		->where('advertisement_id', $id)->select('delivery_methods.id as id', 'delivery_methods.name as name')->lists('name', 'id');

	// 	return view('transaction.create', compact('advertisement', 'owner', 'deliveryMethods'));		
	// }

	// public function create($id)
	// {
	// 	$advertisement = Advertisement::findOrFail($id);
	// 	$owner = User::findOrFail($advertisement->owner_id);
	// 	$deliveryMethods = AdvertisementDelivery::join('delivery_methods', 'delivery_methods.id', '=', 'advertisement_deleivery_methods.delivery_method_id')
	// 		->where('advertisement_id', $id)->select('delivery_methods.id as id', 'delivery_methods.name as name')->lists('name', 'id');

	// 	return view('transaction.create', compact('advertisement', 'owner', 'deliveryMethods'));		
	// }




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	// public function doneDeals(){
	// 	//Transaction as advertisements
	// 	//$advertisements = Transaction::where('buyer_id', Auth::id())->get();

	// 	$advertisements = Advertisement::join('done_deals', 'done_deals.advertisement_id', '=', 'advertisements.id')
	// 			->leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
	// 			->where('buyer_id', Auth::id())
	// 			->select('done_deals.id as id', 'name', 'src', 'price', 'place', 'done_deals.number_of_copies as number_of_copies', 'is_accepted')
	// 			->get();

	// 	return view('transaction.buyThings', compact('advertisements'));
	// }

	// public function soldThings(){
	// 	//Transaction as advertisements
	// 	//$advertisements = Transaction::where('buyer_id', Auth::id())->get();

	// 	$advertisements = Advertisement::join('done_deals', 'done_deals.advertisement_id', '=', 'advertisements.id')
	// 			->leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
	// 			->where('done_deals.owner_id', Auth::id())
	// 			->select('done_deals.id as id', 'name', 'src', 'price', 'place', 'done_deals.number_of_copies as number_of_copies', 'is_accepted')
	// 			->get();
				
	// 	return view('transaction.soldThings', compact('advertisements'));
	// }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$transaction = Transaction::join('transaction_products', 'transaction_products.transaction_id', '=', 'transactions.id')
			->join('advertisements', 'advertisements.id', '=' ,'transaction_products.product_id')
			->join('transaction_statuses', 'transaction_statuses.id', '=', 'transactions.transaction_status_id')
			->join('delivery_methods', 'delivery_methods.id', '=', 'transactions.delivery_method_id')
			->select('transactions.id as id', 'transactions.created_at', 'transaction_statuses.name as status', 
				'delivery_methods.name as delivery_method', 'delivery_methods.cost as delivery_cost', 'transaction_statuses.id as status_id')
			->where('transactions.id', $id)->first();


		$products = TransactionProduct::join('advertisements', 'advertisements.id', '=' ,'transaction_products.product_id')
			->leftjoin('photos', 'photos.id', '=', 'advertisements.photo_id')
			->where('transaction_id', $id)
			->select('advertisements.name', 'transaction_products.number_of_copies', 'photos.icon_src', 'advertisements.price', 'advertisements.id as advertisement_id')
			->get();

		// $advertisement = Advertisement::join('done_deals', 'done_deals.advertisement_id', '=', 'advertisements.id')
		// 		->leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
		// 		->where('done_deals.id', $id)
		// 		->select('done_deals.id as id', 'advertisements.id as advertisement_id' , 'name', 'done_deals.created_at', 'src', 
		// 			'price', 'place', 'done_deals.number_of_copies as number_of_copies', 'is_accepted', 'done_deals.owner_id', 
		// 			'buyer_id' , 'delivery_method_id')
		// 		->first();
		
		// $deliveryMethod = DeliveryMethod::findOrFail($advertisement->delivery_method_id);
		// $owner = User::findOrFail($advertisement->owner_id);
		// $buyer = User::findOrFail($advertisement->buyer_id);

		return view('transaction.show', compact('transaction', 'products'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function remove($id)
	{
		$transaction = Transaction::findOrFail($id);
		$transaction->transaction_status_id = 5;
		$transaction->save();

		return redirect('/')->with('positive_message', 'Zamówienie zostało anulowane');
	}

	public function acceptTransaction($id){
		$transaction = Transaction::findOrFail($id);
		$transaction->is_accepted = true;
		$transaction->save();

		return "Transakcja zaakceptowana poprawnie.";
	}
}
