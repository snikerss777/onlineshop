@extends('app')


@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/bracketShow.css">
@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li class="active">Złożone zamówienia</li>
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

		@include('menus.userMenu')

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Złożone zamówienia</div>
				
				<div class="panel-body" >
				@if(count($products) == 0)
				    <div class="alert alert-info alert-dismissable">
				    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    	Nie kupiłeś żadnego przedmiotu
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
							</tr>
						</thead>

						<tbody>
						
							@foreach($products as $product)
								<tr onclick="clickRow({{$product->id}})">
									<td>{{$product->id}}</td>
									<td>{{ $product->status }}</td>
									<td>{{$product->number_of_products}}</td>
									<td>{{ number_format($product->total_cost + $product->delivery_cost, 2, ',', ' ') }} zł</td>
									<td>{{$product->delivery_name}}</td>
									<td>{{ $product->created_at }}</td>
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