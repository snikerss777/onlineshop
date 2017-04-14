<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Category;

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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

}
