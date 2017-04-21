<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Advertisement;
use App\Product;
use App\Image;
use Session;
use Carbon;
use App\Transaction;
use App\TransactionProduct;

class BracketController extends Controller {



	public function postBracket(Request $request){
		if($request->has('convertCost')){
			return $this->convertCost($request);
		}
		else if($request->has('storeTransaction')){
			return $this->storeTransaction($request);
		}

	}


	public function index(){
		if(Session::has('products')){
			$products = Session::get('products');
			$cost = $this->getCost($products);
			$deliveryMethods = $this->getDeliveryMethods($products);

		}
		else {
			$products = [];
			$cost = 0;
			$deliveryMethods = [];
		}
		
		return view('bracket.show', compact('products' ,'cost', 'deliveryMethods'));
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
					array_splice($products, $i, 1);
					Session::put('products', $products);
					Session::save();
					break;
				}
			}

		}
		return redirect('/bracket')->with('positive_message', 'Produkt został usunięty z koszyka.');
	}

	private function convertCost($request)
	{

		$inputs = $request->all();
		if(count($inputs) >1 ){
			$products = Session::get('products');
			$errors = [];
			foreach ($products as $product) {
				$name = 'numberOfCopies'. $product->advertisement_id;
				$advertisement = Advertisement::findOrFail($product->advertisement_id);
				if($advertisement->number_of_copies < $inputs[$name]){
					array_push($errors, 'Nie możesz kupić większej liczby egzemplarzy produktu: '.$advertisement->name.' niż jest na stanie('.$advertisement->number_of_copies.').');
					$product->number_of_copies = $advertisement->number_of_copies;
				} else {
					$product->number_of_copies = $inputs[$name];
				}

			}

			if(count($errors) > 0){
				return redirect()->back()->with($inputs)->withErrors($errors);
			}

			Session::put('products', $products);
			Session::save();
			
		}

		return redirect('/bracket')->with('positive_message', 'Koszt zakupów został przeliczony.');
		
	}


	// create transaction 

	public function storeTransaction($request)
	{
		$inputs = $request->all();
		$inputs['transaction_status_id'] = 1;
		$inputs['created_at'] =  Carbon\Carbon::now();

		$products = Session::get('products');

		$errors = [];
		$advertisements = [];
		foreach ($products as $product) {
			$advertisement = Advertisement::findOrFail($product->advertisement_id);
			array_push($advertisements, $advertisement);
			if($advertisement->number_of_copies < $product->number_of_copies){
				array_push($errors, 'Nie możesz kupić większej liczby egzemplarzy produktu: '.$advertisement->name.' niż jest na stanie('.$advertisement->number_of_copies.').');
			}
		
		}

		if(count($errors) > 0 ) {
			return redirect()->back()->with($inputs)->withErrors($errors);
		}

		$transaction = Transaction::create($inputs);

		for ($i=0; $i < count($advertisements) ; $i++) { 
			$advertisements[$i]->number_of_copies = $advertisements[$i]->number_of_copies - $products[$i]->number_of_copies;
			$advertisements[$i]->save();

			TransactionProduct::create( ['transaction_id' => $transaction->id, 'product_id' => $advertisements[$i]->id, 'number_of_copies' => $products[$i]->number_of_copies ]);

		}
		Session::forget('products');
				
		if($inputs['delivery_method_id'] == 3){
			return redirect('/')->with('positive_message', 'Transakcja została przyjęta. Po wykonaniu przelewu, zamówienie zostanie zrealizowane.'); 
		}
		else if ($inputs['delivery_method_id'] == 1){
			return redirect('/')->with('positive_message', 'Transakcja została przyjęta. Zgłoś się do naszego punktu by odebrać zamówienie.'); 
		}
		else {
		return redirect('/')->with('positive_message', 'Transakcja została przyjęta.'); 
		}
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

	private function getDeliveryMethods($products){
		$productIds = $this->getProductIds($products);
		$count = count($products);
		$advertisements = Advertisement::whereIn('advertisements.id', $productIds)
			->join('advertisement_deleivery_methods', 'advertisements.id', '=', 'advertisement_deleivery_methods.advertisement_id')
			->join('delivery_methods', 'delivery_methods.id', '=', 'advertisement_deleivery_methods.delivery_method_id')
			->groupBy('delivery_method_id')
			->havingRaw('COUNT(*) = '. $count)
			->select(\DB::raw('count(*) as total'), 'delivery_method_id as id', 
				'delivery_methods.name', 'delivery_methods.cost')->get();


		return $advertisements;
	}

	private function getProductIds($products){
		$productsIds = [];
		foreach ($products as $product) {
			array_push($productsIds, $product->advertisement_id);
		}
		return $productsIds;
	}

	private function getDeliveryMethodsIds($advertisements){
		$deliveryMethods = [];
		foreach ($advertisements as $advertisement) {
			array_push($productsIds, $advertisements->advertisement_id);
		}
		return $productsIds;
	}
}
