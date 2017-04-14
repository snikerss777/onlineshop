<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Advertisement;
use App\Category;
use App\AdvertisementStatus;
use Auth;
use Carbon;
use Illuminate\Http\Response;
use App\Image;
use App\User;
use App\AdvertisementDelivery;
use App\DeliveryMethod;
use App\ObservedAdvertisement;

class AdvertisementController extends Controller {

	
	public function __construct(Request $request, Advertisement $advertisement)
   	{
       $this->request = $request;
       $this->advertisement = $advertisement;
       $this->counter = 0;
  	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		if($id == 0){
			$advertisements = Advertisement::leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
				->select('advertisements.id as id', 'name', 'category_id' , 'owner_id', 'src', 'photo_id', 'price', 'place')
				->get();
		} 
		else{
			$category = Category::findOrFail($id);
			$categories = $category->allChildCategories([])->lists('id');
			array_push($categories, $id);
			$advertisements = Advertisement::leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
				->whereIn('category_id', $categories)
				->select('advertisements.id as id', 'name', 'category_id' , 'owner_id', 'src', 'photo_id', 'price', 'place')
				->get();
		}
		return $advertisements;
		return new Response($advertisements);
	}

	public function getAdvertisementsByCategory($id){
		$category = Category::findOrFail($id);
			$categories = $category->allChildCategories([])->lists('id');

			$advertisements = Advertisement::whereIn('category_id', $categories)->get();
			return $advertisements->lists('name');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$deliveryMethods = DeliveryMethod::all();

		return view('advertisement.create', compact('deliveryMethods'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = $this->advertisement->rules;

		$inputs = $this->request->all();
		
		$this->validate($this->request, $rules);
		$catId = 0;
		
		if($this->request->has('category_id4') && !strpos($this->request->input('category_id4'), "undefined") !== false){
			$catId = $this->request->input('category_id4');
		}
		else if($this->request->has('category_id3') && !strpos($this->request->input('category_id3'), "undefined") !== false){
			$catId = $this->request->input('category_id3');
		}
		else if($this->request->has('category_id2') && !strpos($this->request->input('category_id2'), "undefined") !== false){
			$catId = $this->request->input('category_id2');
		}
		else if($this->request->has('category_id1') && !strpos($this->request->input('category_id1'), "undefined") !== false){
			$catId = $this->request->input('category_id1');
		}
		else if($this->request->has('category_id') && !strpos($this->request->input('category_id'), "undefined") !== false){
			$catId = $this->request->input('category_id');
		}
		else{
			return redirect()->back()->with($inputs)->withErrors(['Nie wybrałeś żadnej kategorii.']);
		}

		$categories = Category::where('above_category', $catId)->get();
		if(sizeof($categories) != 0){
			return redirect()->back()->with($inputs)->withErrors(['Nie możesz wybrać kategorii, która posiada podkategorię.']);
		}		

		$inputs['advertisement_status_id'] = AdvertisementStatus::where('name', 'Do akceptacji')->first()->id;
		$inputs['owner_id'] = Auth::id();
		$inputs['category_id'] = $catId;
		$inputs['created_at'] = Carbon\Carbon::now();
		//$inputs['photo_src'] = ""; //TODO

		$advertisement = Advertisement::create($inputs);
		$deliveryMethods = $this->request->input('deliveryMethods');

		foreach ($deliveryMethods as $deliveryMethod) {
			AdvertisementDelivery::create(['advertisement_id' => $advertisement->id, 'delivery_method_id' => $deliveryMethod]);
		}
		
		return redirect("/upload/".$advertisement->id)->with('positive_message', 'Twoje ogłoszenie zostało dodane. Teraz czeka na akceptacje administratora.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$advertisement = Advertisement::findOrFail($id);
		$images = Image::where('advertisement_id', $id)->get();
		$owner = User::findOrFail($advertisement->owner_id);
		$deliveries = AdvertisementDelivery::join('delivery_methods', 'delivery_methods.id', '=', 'advertisement_deleivery_methods.delivery_method_id')
			->where('advertisement_deleivery_methods.advertisement_id', $id)->get();
		$observedAdvertisement = ObservedAdvertisement::where('advertisement_id', $id)
			->where('user_id', Auth::id())->first();
		if($observedAdvertisement == null){
			$observedAdvertisementId = 0;
		}
		else{
			$observedAdvertisementId = $observedAdvertisement->id;
		}

		return view('advertisement.show', compact('advertisement', 'images', 'owner', 'deliveries', 'observedAdvertisementId'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$deliveryMethods = DeliveryMethod::all();
		$advertisementDeliveryMethods = AdvertisementDelivery::where('advertisement_id', $id)->lists('delivery_method_id');

		$advertisement = Advertisement::findOrFail($id);

		return view('advertisement.edit', compact('advertisement', 'deliveryMethods', 'advertisementDeliveryMethods'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = $this->advertisement->rules;
		$inputs = $this->request->all();
		$this->validate($this->request, $rules);

		$inputs['category_id'] = $this->selectCategory();
		
		$advertisement = Advertisement::findOrFail($id);
		$advertisement->update($inputs);
		
		$this->setDeliveryMethods($advertisement);
		
		return redirect("/")->with('positive_message', 'Twoje ogłoszenie zostało zmienione.');

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


	public function myAdvertisements(){

		$advertisements = Advertisement::leftJoin('photos', 'advertisements.photo_id', '=', 'photos.id')
				->where('owner_id', Auth::id())
				->select('advertisements.id as id', 'name', 'category_id' , 'owner_id', 'src', 'photo_id', 'price', 'place', 'number_of_copies')
				->get();

		$is_accepted = false;
		
		return view('advertisement.myAdvertisements', compact('advertisements', 'is_accepted'));
	}


	public function setIconImage(Request $request){
		$imageId =  $request->input('imageId');

		$image = Image::findOrFail($imageId);
		$advertisement = Advertisement::findOrFail($image->advertisement_id);
		$advertisement->photo_id = $imageId;
		$advertisement->save();

		return "Miniaturka ogłoszenia została zmieniona";
	}


	private function selectCategory(){
		$catId = 0;

		if($this->request->has('category_id4') && !strpos($this->request->input('category_id4'), "undefined") !== false){
			$catId = $this->request->input('category_id4');
		}
		else if($this->request->has('category_id3') && !strpos($this->request->input('category_id3'), "undefined") !== false){
			$catId = $this->request->input('category_id3');
		}
		else if($this->request->has('category_id2') && !strpos($this->request->input('category_id2'), "undefined") !== false){
			$catId = $this->request->input('category_id2');
		}
		else if($this->request->has('category_id1') && !strpos($this->request->input('category_id1'), "undefined") !== false){
			$catId = $this->request->input('category_id1');
		}
		else if($this->request->has('category_id') && !strpos($this->request->input('category_id'), "undefined") !== false){
			$catId = $this->request->input('category_id');
		}
		else{
			return redirect()->back()->with($inputs)->withErrors(['Nie wybrałeś żadnej kategorii.']);
		}
		return $catId;
	}

	private function setDeliveryMethods($advertisement){
		$deliveryMethods = $this->request->input('deliveryMethods');
		$oldDeliveryMethods = AdvertisementDelivery::where('advertisement_id', $advertisement->id);
		foreach ($deliveryMethods as $deliveryMethod) {
			
			AdvertisementDelivery::create(['advertisement_id' => $advertisement->id, 'delivery_method_id' => $deliveryMethod]);
		}
	}

}
