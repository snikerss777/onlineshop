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
			$advertisements = Advertisement::all();
		} 
		else{
			$category = Category::findOrFail($id);
			$categories = $category->allChildCategories([])->lists('id');
			array_push($categories, $id);
			$advertisements = Advertisement::whereIn('category_id', $categories)->get();
		}
		
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
		return view('advertisement.create');
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
		$inputs['photo_src'] = ""; //TODO

		Advertisement::create($inputs);
		
		return redirect("/")->with('positive_message', 'Twoje ogłoszenie zostało dodane. Teraz czeka na akceptacje administratora.');
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

		return view('advertisement.show', compact('advertisement'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$advertisement = Advertisement::findOrFail($id);

		return view('advertisement.edit');
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

}
