@extends('app')


@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/bracketShow.css">
		<link href="{{ asset('/css/transactionShow.css') }}" rel="stylesheet">

@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		@if(Auth::user()->kind_of_user_id == 6)
  		<li><a href="/userTransactions/{{Auth::id()}}">Moje transakcje </a></li>
  		@else
  		<li><a href="/admin/transactions">Transakcje klientów </a></li>
  		@endif
  		<li class="active">Zamówienie numer: {{$transaction->id}}</li>
	</ol>

@endsection

@section('content')

	<div class="row" >
		@if(Auth::user()->kind_of_user_id == 6)

			@include('menus.userMenu')

		@else 

			@include('menus.adminMenu')

		@endif

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
								@if(Auth::user()->kind_of_user_id != 6)
									<li class="list-item">Klient: <a href="/my_account/{{ $transaction->buyer_id }}">{{$transaction->firstname}} {{$transaction->lastname}} </a></li>
								@endif
							</ul>
						</div>

						<div class="col-sm-6">
							<ul class="transactionShowUl">
								<li class="list-item">Sposób dostawy: {{$transaction->delivery_method}}</li>
								<li class="list-item">Koszt dostawy:  {{ number_format($transaction->delivery_cost, 2, ',', ' ') }} zł</li>
								@if($transaction->status_id == 1 && Auth::user()->kind_of_user_id == 6)
									<li style="margin-top:20px;" class="list-item"><a href="/transaction/remove/{{$transaction->id}}" class="buttonMakeAnOrder" >Anuluj zamówienie</a></li>
								@elseif($transaction->status_id < 3 && Auth::user()->kind_of_user_id != 6) 
									<li class="list-item">
										<button class="btn buttonMakeAnOrder dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										    Zmień status
										    <span class="caret"></span>
										</button>
										 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										    <li><a href="/transaction/changeStatus/{{$transaction->id}}/1">Przyjęty</a></li>
										    <li><a href="/transaction/changeStatus/{{$transaction->id}}/2">W trakcie realizacji</a></li>
										    <li><a href="/transaction/changeStatus/{{$transaction->id}}/3">Zrealizowane</a></li>
										    <li><a href="/transaction/changeStatus/{{$transaction->id}}/4">Odrzucone</a></li>
										 </ul>
									</li>
								@endif
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

