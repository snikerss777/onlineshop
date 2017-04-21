@extends('app')


@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/bracketShow.css">
@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li class="active">Koszyk</li>
	</ol>

	@if ( session()->has('positive_message') )
    <div class="alert alert-success alert-dismissable">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	{{ session()->get('positive_message') }}
    </div>
    @endif

    @if ( session()->has('anger_message') )
    <div class="alert alert-success alert-dismissable">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	{{ session()->get('anger_message') }}
    </div>
    @endif

    @include('errors.user')

@endsection

@section('content')

	<div class="row" >

		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">Zawartość Twojego koszyka</div>
				
				<div class="panel-body" >
				{!! Form::open(['method' => 'POST', 'action' => ['BracketController@postBracket'] ]) !!}
				@if(count($products) == 0)
				    <div class="alert alert-info alert-dismissable">
				    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    	Twój koszyk jest pusty
				    </div>
				@else	
					<table class="table table-condensed">
						<thead>
							<tr>
								<th class="imageTd"></th>
								<th>Produkt</th>
								<th>Ilość</th>	
								<th>Cena</th>
								<th>Wartość</th>
								<th>Akcje</th>
							</tr>
						</thead>

						<tbody>
						
							@foreach($products as $product)
								<tr>
									<td class="imageTd"><image src="/images/{{$product->src}}"></td>
									<td><a href="/advertisement/{{$product->advertisement_id}}">{{$product->name}}</a></td>
									<td><input name="numberOfCopies{{$product->advertisement_id}}" onchange="changeNumberOfCopies()" value="{{$product->number_of_copies}}" class="form-control" type="number"></td>
									<td>{{ number_format($product->price, 2, ',', ' ') }} zł</td>
									<td>{{ number_format($product->number_of_copies * $product->price, 2, ',', ' ') }} zł</td>
									<td><a href="/bracket/remove/{{$product->advertisement_id}}"><i class="glyphicon glyphicon-remove"></i></td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row">
						<div class="col-xs-5">
							<h4>Wybierz sposób dostawy</h4>
							@foreach($deliveryMethods as $index => $deliveryMethod)	
								<div class="radio">
								  <label><input @if($index == 0) checked @endif type="radio" onchange="changeDeliveryMethod({{$deliveryMethod->id}})" value="{{$deliveryMethod->cost}}" name="optradio">
								  	{{$deliveryMethod->name}} <span> {{ number_format($deliveryMethod->cost, 2, ',', ' ') }} zł</span></label>
								</div>
							@endforeach
						</div>
						<div class="col-xs-1">

						</div>

						<div class="col-xs-6 paidContainer" >
							<button type="submit" class="btn btn-primary buttonMakeAnOrder" style="display:none;" id="buttonConvert" name="convertCost" value="123" 
									>PRZELICZ PONOWNIE</button>
							<h4>Razem: <span> {{  number_format($cost, 2, ',', ' ') }}</span> zł</h4>
							<h4 id="transportCostHeading">Koszt transportu: <span>{{  number_format($deliveryMethods[0]->cost, 2, ',', ' ') }}</span> zł </h4>
							<h3 id="totalCostHeading"> <b> Do zapłaty: <span >{{  number_format($cost + $deliveryMethods[0]->cost, 2, ',', ' ') }} zł</span> </b></h3>
							<input  id="hiddenTotalCost" type="hidden" value="{{$cost + $deliveryMethods[0]->cost}}" name="totalCost">
							<input  id="buyer_id" type="hidden" name="buyer_id" value="{{Auth::id()}}">
							<input  id="delivery_method_id" type="hidden" name="delivery_method_id" value="1">
							<button class="btn btn-primary buttonMakeAnOrder" href="" id="buttonOrder" type="submit" name="storeTransaction" value="11">ZŁÓŻ ZAMÓWIENIE</button>
						</div>

					</div>
				@endif
				{!! Form::close() !!}	
				</div>
			</div>
		</div>
	</div>

@endsection



@section('scripts')

<script type="text/javascript" src="/js/bracketShow.js"></script>

@endsection
