<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\ObservedAdvertisement;
use App\Advertisement;
use Auth;
use Illuminate\Http\Response;

class ObservedAdvertisementController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$observedAdvertisements = ObservedAdvertisement::where('user_id', Auth::id())->lists('advertisement_id');

		$advertisements = Advertisement::leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
				->whereIn('advertisements.id', $observedAdvertisements)
				->select('advertisements.id as id', 'name', 'category_id' , 'owner_id', 'src', 'photo_id', 'price', 'place')
				->get();

		return view('advertisement.observed', compact('advertisements'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($advertisementId, Request $request )
	{
        $observedAdvertisement = ObservedAdvertisement::create(['user_id' => Auth::id(), 'advertisement_id' => $advertisementId]);

		return (new Response($observedAdvertisement->id));
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$observedAdvertisement = ObservedAdvertisement::findOrFail($id);
		$observedAdvertisement->delete();
		return 'Obserwowane ogłoszenie usuniete';

	}

}
