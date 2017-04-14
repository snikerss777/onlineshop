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

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($id)
	{
		$advertisement = Advertisement::findOrFail($id);
		$owner = User::findOrFail($advertisement->owner_id);
		$deliveryMethods = AdvertisementDelivery::join('delivery_methods', 'delivery_methods.id', '=', 'advertisement_deleivery_methods.delivery_method_id')
			->where('advertisement_id', $id)->select('delivery_methods.id as id', 'delivery_methods.name as name')->lists('name', 'id');

		return view('transaction.create', compact('advertisement', 'owner', 'deliveryMethods'));		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$inputs = $request->all();
		$inputs['is_accepted'] = false;
		$inputs['created_at'] =  Carbon\Carbon::now();

		$advertisement = Advertisement::findOrFail($inputs['advertisement_id']);
		if($advertisement->number_of_copies < $inputs['number_of_copies']){
			return redirect()->back()->with($inputs)->withErrors(['Nie możesz kupić większej liczby egzemplarzy niż jest na stanie.']);
		}

		$advertisement->number_of_copies = $advertisement->number_of_copies - $inputs['number_of_copies'];
		$advertisement->save();

		Transaction::create($inputs);
		
		return redirect('/')->with('positive_message', 'Przedmiot został zakupiony, możesz go sprawdzić w zakładce "Zakupione przedmioty".'); 
	}

	public function doneDeals(){
		//Transaction as advertisements
		//$advertisements = Transaction::where('buyer_id', Auth::id())->get();

		$advertisements = Advertisement::join('done_deals', 'done_deals.advertisement_id', '=', 'advertisements.id')
				->leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
				->where('buyer_id', Auth::id())
				->select('done_deals.id as id', 'name', 'src', 'price', 'place', 'done_deals.number_of_copies as number_of_copies', 'is_accepted')
				->get();

		return view('transaction.buyThings', compact('advertisements'));
	}

	public function soldThings(){
		//Transaction as advertisements
		//$advertisements = Transaction::where('buyer_id', Auth::id())->get();

		$advertisements = Advertisement::join('done_deals', 'done_deals.advertisement_id', '=', 'advertisements.id')
				->leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
				->where('done_deals.owner_id', Auth::id())
				->select('done_deals.id as id', 'name', 'src', 'price', 'place', 'done_deals.number_of_copies as number_of_copies', 'is_accepted')
				->get();
				
		return view('transaction.soldThings', compact('advertisements'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$advertisement = Advertisement::join('done_deals', 'done_deals.advertisement_id', '=', 'advertisements.id')
				->leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
				->where('done_deals.id', $id)
				->select('done_deals.id as id', 'advertisements.id as advertisement_id' , 'name', 'done_deals.created_at', 'src', 
					'price', 'place', 'done_deals.number_of_copies as number_of_copies', 'is_accepted', 'done_deals.owner_id', 
					'buyer_id' , 'delivery_method_id')
				->first();
		
		$deliveryMethod = DeliveryMethod::findOrFail($advertisement->delivery_method_id);
		$owner = User::findOrFail($advertisement->owner_id);
		$buyer = User::findOrFail($advertisement->buyer_id);

		return view('transaction.show', compact('advertisement', 'deliveryMethod', 'owner', 'buyer'));
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

	public function acceptTransaction($id){
		$transaction = Transaction::findOrFail($id);
		$transaction->is_accepted = true;
		$transaction->save();

		return "Transakcja zaakceptowana poprawnie.";
	}
}
