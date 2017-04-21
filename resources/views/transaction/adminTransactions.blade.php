@extends('app')


@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/bracketShow.css">
@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li class="active">Zamówienia klientów</li>
	</ol>

	@if ( session()->has('positive_message') )
    <div class="alert alert-success alert-dismissable">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	{{ session()->get('positive_message') }}
    </div>
    @endif


@endsection

@section('content')

	<div class="row" >

		@include('menus.adminMenu')

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Zamówienia klientów</div>
				
				<div class="panel-body" >
				@if(count($products) == 0)
				    <div class="alert alert-info alert-dismissable">
				    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    	Brak nowych zamówień
				    </div>
				@else	
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Numer zamówienia</th>
								<th>Status</th>
								<th>Ilość produktów</th>	
								<th>Calkowity koszt </th>
								<th>Sposób dostawy</th>
								<th>Data zamówienia</th>
								<th>Akcje</th>
							</tr>
						</thead>

						<tbody>
						
							@foreach($products as $product)
								<tr>
									<td onclick="clickRow({{$product->id}})">{{$product->id}}</td>
									<td onclick="clickRow({{$product->id}})">{{ $product->status }}</td>
									<td onclick="clickRow({{$product->id}})">{{$product->number_of_products}}</td>
									<td onclick="clickRow({{$product->id}})">{{ number_format($product->total_cost + $product->delivery_cost, 2, ',', ' ') }} zł</td>
									<td onclick="clickRow({{$product->id}})">{{$product->delivery_name}}</td>
									<td onclick="clickRow({{$product->id}})">{{ $product->created_at }}</td>
									<!-- <td><i class="glyphicon glyphicon-th-list" onclick=""></i></td> -->
									<td>
										<div class="dropdown">
										  <i class="glyphicon glyphicon-th-list dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
										    
										  </i>
										  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
										    <li class="dropdown-header">Zmień status na:</li>
										    <li><a href="/transaction/changeStatus/{{$product->id}}/1">Przyjęty</a></li>
										    <li><a href="/transaction/changeStatus/{{$product->id}}/2">W trakcie realizacji</a></li>
										    <li><a href="/transaction/changeStatus/{{$product->id}}/3">Zrealizowane</a></li>
										    <li><a href="/transaction/changeStatus/{{$product->id}}/4">Odrzucone</a></li>
										  </ul>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

				
				@endif

				</div>
			</div>
		</div>
	</div>

@endsection



@section('scripts')

<script type="text/javascript" src="/js/userTransactions.js"></script>

@endsection