@extends('app')


@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/bracketShow.css">
@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li class="active">Zakupione przedmioty</li>
	</ol>

@endsection

@section('content')

	<div class="row" >

		@include('menus.userMenu')

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Zakupione przedmioty</div>
				
				<div class="panel-body" >
				@if(count($products) == 0)
				    <div class="alert alert-info alert-dismissable">
				    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    	Nie kupiłeś żadnego przedmiotu
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
								<th>Data kupna</th>
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

