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

@endsection

@section('content')

	<div class="row" >

		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">Zawartość Twojego koszyka</div>
				
				<div class="panel-body" >

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
									<td><input onchange="changeNumberOfCopies()" value="{{$product->number_of_copies}}" class="form-control" type="number"></td>
									<td>{{ number_format($product->price, 2, ',', ' ') }} zł</td>
									<td>{{ number_format($product->number_of_copies * $product->price, 2, ',', ' ') }} zł</td>
									<td><a href="/bracket/remove/{{$product->advertisement_id}}"><i class="glyphicon glyphicon-remove"></i></td>
								</tr>
							@endforeach
						</tbody>
							
					</table>

					<div class="row">
						<div class="col-xs-6">
							<h4>Wybierz sposób dostawy</h4>

						</div>

						<div class="col-xs-6 paidContainer" >
							<a class="btn btn-primary buttonMakeAnOrder" style="display:none;" id="buttonConvert" 
												href="/bracket/convertCost" >PRZELICZ PONOWNIE</a>
							<h4>Razem: {{  number_format($cost, 2, ',', ' ') }} zł</h4>
							<h4>Koszt transportu: </h4>
							<h3> <b> Do zapłaty: <span>{{  number_format($cost, 2, ',', ' ') }} zł</span> </b></h3>
							<a class="btn btn-primary buttonMakeAnOrder" href="" id="buttonOrder">ZŁÓŻ ZAMÓWIENIE</a>
						</div>

					</div>
				@endif			
				</div>
			</div>
		</div>
	</div>

@endsection



@section('scripts')

<script type="text/javascript" src="/js/bracketShow.js"></script>

@endsection
