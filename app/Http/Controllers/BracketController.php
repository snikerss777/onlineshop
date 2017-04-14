<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Advertisement;
use App\Product;
use App\Image;
use Session;

class BracketController extends Controller {


	public function index(){
		$products = Session::get('products');
		$cost = $this->getCost($products);

		return view('bracket.show', compact('products' ,'cost'));
	}


	public function show($id)
	{
		$advertisement = Advertisement::findOrFail($id);
		$src = $this->getSrc($advertisement);
		$product = $this->createProduct($advertisement, $src);

		if(Session::has('products')){
			$products = Session::pull('products');

			$isProductInArray = false;
			foreach ($products as $myProduct) {
				if($myProduct->advertisement_id == $product->advertisement_id){
					$myProduct->number_of_copies++;
					$isProductInArray = true;
				}

			}

			if(!$isProductInArray){
				array_push($products, $product);
			}
			Session::put('products', $products);
		} else{
			Session::push('products', $product );
		}
		Session::save();
		
		return redirect('/bracket')->with('positive_message', 'Produkt został dodany do koszyka.');
	}

	public function removeProduct($id){
		if(Session::has('products')) {		
			$products = Session::get('products');

			for ($i=0; $i < count($products); $i++) { 
				if($products[$i]->advertisement_id == $id){
					array_splice($products, 1, 1);
					Session::put('products', $products);
					break;
				}
			}

		}
		return redirect('/bracket')->with('positive_message', 'Produkt został usunięty z koszyka.');
	}

	public function convertCost()
	{
		$cost = 0;
		
	}


	private function createProduct($advertisement, $src){
		$product = new Product;
		$product->advertisement_id = $advertisement->id;
		$product->src = $src;
		$product->name = $advertisement->name;
		$product->price = $advertisement->price;
		$product->number_of_copies = 1;

		return $product;
	}

	private function getSrc($advertisement){
		$image = Image::where('id' , $advertisement->photo_id)->first();
		if(is_null($image) || is_null($image->icon_src)){
			$src = 'defaultIcon.png';
		} else{
			$src = $image->icon_src;
		}

		return $src;
	}

	private function getCost($products){
		$cost = 0;
		foreach ($products as $product ) {
			$cost += $product->price * $product->number_of_copies;
		}
		return $cost;
	}

}
