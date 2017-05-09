<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Category;
use App\Advertisement;

class CategoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{

		if($id == 0){
			$categories = Category::whereNull('above_category')->get();

		}
		else {
			$categories = Category::where('above_category', $id)->get();
		}

		return (new Response($categories));
	}


	public function getEditCategories($id)
	{
		$mainCategories = Category::whereNull('above_category')->get();
		$category = Category::findOrFail($id);
		$levelId = 1;
		$categories = [];
		$categoryIds = [];
		while (!is_null($category->above_category)) {
			$levelId ++;
			$myCategories = Category::where('above_category', $category->above_category)->select('id', 'name')->get();
			array_push($categories, $myCategories);
			array_push($categoryIds, (string) $category->id);

			$category = Category::findOrFail($category->above_category);

		}
		array_push($categoryIds, (string) $category->id);

		$categories = array_reverse ($categories);
		$categoryIds =  array_reverse ($categoryIds);
		array_push($categories, []);

		$data['categories'] = $categories;
		$data['levelId'] = $levelId;
		$data['categoryIds'] = $categoryIds;
		$data['mainCategories'] = $mainCategories;

		return $data;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, Category $category)
	{
		$this->validate($request, $category->rules);
		$inputs = $request->all();
		$newCategory = new Category;
		$newCategory->name = $inputs['newCategory'];
		if(!empty($inputs['above_category'])){
			$newCategory->above_category = $inputs['above_category'];
		} else {
			$newCategory->above_category = null;
		}
		$newCategory->save();

		return redirect('/category/create')->with('positive_message', 'Nowa kategoria została dodana');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		return view('categories.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{
		$inputs = $request->all();

		$category = Category::findOrFail($inputs['oldCategoryId']);
		$oldCategoryName = $category->name;
		$category->name = $inputs['newCategoryName'];
		$category->save();

		return redirect('/')->with('positive_message', 'Nazwa kategorii: '.$oldCategoryName.' została zmieniona na: '.$category->name.'.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$categories = Category::where('above_category', $id)->get();
		$advertisements = Advertisement::where('category_id', $id)->get();
		$category = Category::findOrFail($id);

		if(count($categories) > 0){
			return redirect('/category/remove')->withErrors(['Nie możesz usunąć kategorii: '.$category->name.' ponieważ posiada ona podkategorię. Aby ją usunąć, najpierw musisz usunąć jej wszystkie podkategorię']);
		} elseif (count($advertisements)) {
			return redirect('/category/remove')->withErrors(['Nie możesz usunąć kategorii: '.$category->name.' ponieważ posiada ona podkategorię. Aby ją usunąć, najpierw musisz usunąć wszystkie ogłoszenia dla tej kategorii']);
		}
		
		$category->delete();
		return redirect('/category/remove')->with('positive_message', 'Kategoria została usunięta');
	}

	public function remove()
	{
		return view('categories.remove');
	}


}
