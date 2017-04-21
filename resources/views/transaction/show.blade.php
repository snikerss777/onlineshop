@extends('app')


@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/bracketShow.css">
@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li><a href="/userTransactions/{{Auth::id()}}">Moje transakcje </a></li>
  		<li class="active">Zamówienie numer: {{$transaction->id}}</li>
	</ol>

@endsection

@section('content')

	<div class="row" >

		@include('menus.userMenu')

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Zamówienie numer: {{$transaction->id}}</div>
				
				<div class="panel-body" >
					
					
					<div class="row">
						<div class="col-sm-12">
							<h3>Dane zamówienia</h3>
						</div>
					</div>
					<div class="row">

						<div class="col-sm-6">
							<ul class="transactionShowUl">
								<li class="list-item">Status zamówienia: <b> {{$transaction->status}} </b></li>
								<li class="list-item">Sposób dostawy: {{$transaction->created_at}}</li>
							</ul>
						</div>

						<div class="col-sm-6">
							<ul class="transactionShowUl">
								<li class="list-item">Sposób dostawy: {{$transaction->delivery_method}}</li>
								<li class="list-item">Koszt dostawy: {{$transaction->delivery_cost}}</li>
								@if($transaction->status_id == 1)<li style="margin-top:20px;" class="list-item"><a href="/transaction/remove/{{$transaction->id}}" class="buttonMakeAnOrder" >Anuluj zamówienie</a></li>@endif
							</ul>
						</div>
					</div>


					<div class="row tableRow">
						
						<div class="col-sm-12">
							<h3>Zamówione produkty</h3>
							<table class="table table-condensed">
								<thead>
									<tr>
										<th class="imageTd"></th>
										<th>Produkt</th>
										<th>Ilość</th>	
										<th>Cena</th>
										<th>Wartość</th>
									</tr>
								</thead>

								<tbody>
								
									@foreach ($products as $product)
										<tr>
											<td class="imageTd"><image @if(is_null($product->icon_src)) src="/images/defaultIcon.png"  @else src="/images/{{$product->icon_src}}" @endif></td>
											<td><a href="/advertisement/{{$product->advertisement_id}}">{{$product->name}}</a></td>
											<td>{{$product->number_of_copies}}</td>
											<td>{{ number_format($product->price, 2, ',', ' ') }} zł</td>
											<td>{{ number_format($product->number_of_copies * $product->price, 2, ',', ' ') }} zł</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection

