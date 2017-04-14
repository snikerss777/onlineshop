@extends('app')



@section('styles')

	<link href="{{ asset('/css/advertisementShow.css') }}" rel="stylesheet">

@endsection



@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li class="active"><a  href="" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li ng-if="categoryIds.length != 0"  ng-repeat="cat in mainCategories | filter:{'id': categoryIds[0]}:true"> <a   href="" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 0)" > <% cat.name %> </a> </li>
  		<li ng-if="categoryIds.length > 1" ng-repeat="cat1 in categories[0] | filter:{'id': categoryIds[1]}:true"> <a  href="" ng-click="getCategoriesWithAdvertisements(cat1.id, 1, 0)" > <% cat1.name %> </a>   </li>
  		<li ng-if="categoryIds.length > 2" ng-repeat="cat2 in categories[1] | filter:{'id': categoryIds[2]}:true" ><a  href="" ng-click="getCategoriesWithAdvertisements(cat2.id, 2, 0)" > <% cat2.name %> </a> </li>
  		<li ng-if="categoryIds.length > 3" ng-repeat="cat3 in categories[2] | filter:{'id': categoryIds[3]}:true" > <a  href="" ng-click="getCategoriesWithAdvertisements(cat3.id, 3, 0)" > <% cat3.name %> </a> </li>
  		<li ng-if="categoryIds.length > 4" ng-repeat="cat4 in categories[3] | filter:{'id': categoryIds[4]}:true" > <a   href="" ng-click="getCategoriesWithAdvertisements(cat4.id, 4, 0)" > <% cat4.name %> </a> </li>		
	
  		<li class="active">{{ $advertisement->name }}</li>
	</ol>

	@if ( session()->has('positive_message') )
    <div class="alert alert-success alert-dismissable">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	{{ session()->get('positive_message') }}
    </div>
    @endif
@endsection



@section('content')

<div class="container" >
	<div class="row" ng-init="getCategoriesWithResetStorage()">

		@include('menus.homeMenu', ['isHome' => 0])

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $advertisement->name }}</div>
				
				<div class="panel-body" >
						<div class="row">
							@if(count($images) != 0)
							<div class="col-sm-7 photoContainer">
								<div id="fullcarousel-example" data-interval="false" class="carousel slide"
						            data-ride="carousel">
						              <div class="carousel-inner">
						              						             
						                @foreach($images as $index => $image)
							                <div id="photoCarouselId{{$index}}" class="item @if($index == 0) active @endif">
							                  <img src="/images/{{$image->src}}">
							                 
							                </div>
						                @endforeach

						              </div>
						              <a class="left carousel-control" href="#fullcarousel-example" data-slide="prev"><i class="icon-prev fa fa-angle-left"></i></a>
						              <a class="right carousel-control" href="#fullcarousel-example" data-slide="next"><i class="icon-next fa fa-angle-right"></i></a>
						        </div>

						        <div class="row imageContainer">
						        	
						        	<div class="col-sm-1">
							        	@if(count($images) > 3 ) <i class="glyphicon glyphicon-menu-left" onclick="getPreviousPhotos()"></i> @endif
 									</div>
						        	@foreach($images as $index => $image)
							                
							                <div id="onePhotoContainerId{{$index}}" class="col-sm-2 col-sm-offset-1 onePhotoContainer @if($index >= 3) myItem @endif">
   												<a href="" onclick="changePhoto({{$index}})"><img class="img-responsive" src="/images/{{$image->src}}" /></a>
 											</div>
 											
						            @endforeach
						           	<div class="col-sm-1">
							        	@if(count($images) >3 ) <i class="glyphicon glyphicon-menu-right" onclick="getNextPhotos({{count($images)}})"></i>@endif
 									</div>
						        	
						        </div>

							</div>

							<div class="col-sm-5" style="float:rigth">
								<h3  class="right">Cena: {{$advertisement->price}} zł</h3>
								<h3  class="right">Liczba dostępnych egzemplarzy: {{$advertisement->number_of_copies}}</h3>

 								@if(!Auth::check())

 								@elseif(Auth::id() != $owner->id) 
									<button class="btn btn-primary btn-lg  right buttonDown2" onclick="goToCreateTransaction({{$advertisement->id}})">Kup teraz</button>
									
										<button class="btn btn-success btn-lg  right buttonDown2 buttonRight"  id="addToObserveButton" @if($observedAdvertisementId != 0) style="display:none" @endif onclick="createObservedAdvertisement({{$advertisement->id}})">Dodaj do obserwowanych</button>
										<button class="btn btn-warning btn-lg  right buttonDown2 buttonRight"  id="removeFromObserveButton"  @if($observedAdvertisementId == 0) style="display:none" @endif onclick="deleteObservedAdvertisement({{$observedAdvertisementId}})">Usuń z obserwowanych</button>
								@else 
									
									<div class="row">
										<div class="col-sm-12">
											<a style="width:50%" href="{{ URL::route('advertisement/edit/', ['id' => $advertisement->id]) }}" class="btn btn-primary btn-lg  right buttonDown2 ">Edytuj ogłoszenie</a>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<a style="width:50%" href="{{ URL::route('upload/', ['id' => $advertisement->id]) }}" class="btn btn-primary btn-lg  right buttonDown2 ">Zarządzaj zdjęciami</a>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12">
											<a style="width:50%" href="{{ URL::route('advertisement/destroy/', ['id' => $advertisement->id]) }}" class="btn btn-warning btn-lg  right buttonDown2 ">Usuń ogłoszenie</a>
										</div>
									</div>

								@endif
							</div>
							@else
								<div class="col-sm-6">
									<h3 class="">Liczba dostępnych egzemplarzy: {{$advertisement->number_of_copies}}</h3>
								</div>

								<div class="col-sm-6">
									<h3 class="right">Cena: {{$advertisement->price}} zł</h3>
									<div class="row">
										<div class="col-sm-12">
											@if(!Auth::check())

											@elseif(Auth::id() == $owner->id) 
												<button class="btn btn-primary btn-lg buttonDown right"  onclick="goToUploadPhoto({{$advertisement->id}})">Zarządzaj zdjęciami</button>
												<button class="btn btn-primary btn-lg buttonDown right buttonRight"  onclick="goToEditAdvertisement({{$advertisement->id}})">Edytuj ogłoszenie</button>
											@else
												<button class="btn btn-primary btn-lg buttonDown right " onclick="goToCreateTransaction({{$advertisement->id}})">Kup teraz</button>
												<button class="btn btn-success btn-lg  buttonDown right buttonRight"  id="addToObserveButton" @if($observedAdvertisementId != 0) style="display:none" @endif onclick="createObservedAdvertisement({{$advertisement->id}})">Dodaj do obserwowanych</button>
												<button class="btn btn-warning btn-lg  buttonDown right buttonRight"  id="removeFromObserveButton"  @if($observedAdvertisementId == 0) style="display:none" @endif onclick="deleteObservedAdvertisement($observedAdvertisementId)">Usuń z obserwowanych</button>
											@endif
										</div>
									</div>
								</div>
							@endif

						</div>	

						<hr>

						<div class="row nextRow">
							
							<div class="col-sm-4">
								<h3>Używane: @if($advertisement->used == 0)Nie @else Tak @endif</h3>

							</div>

							<div class="col-sm-4">
								<h3>Rok Produkcji: {{$advertisement->create_year}}</h3>
							</div>

							<div class="col-sm-4">
								<h3>Miejscowość: {{$advertisement->place}}</h3>
							</div>

						</div>		

						<hr>

						<div class="row nextRow">
							<div class="col-sm-12">
								<h3>Możliwe sposoby dostawy: 
									@foreach($deliveries as $index  => $delivery)
										{{ $delivery->name }}@if($index+1 < count($deliveries)), @else. @endif 
									@endforeach
								</h3>
							</div>
						</div>	

						<hr>

						<div class="row nextRow">
							<div class="col-sm-12">
								<article>
									<h3>Opis:</h3>
									<p>{{ $advertisement->description }}</p>
								</article>
							</div>
						</div>

						<hr>

						<div class="row nextRow">
							<div class="col-sm-6">
								<p><b>Sprzedawca: {{$owner->firstname}} {{$owner->lastname}}</b></p>
								<p>Email: {{ $owner->email }}</p>
								<p>Numer ogłoszenia: {{ $advertisement->id }}</p>
							</div>

							<div class="col-sm-6">
								<p>Pozostały czas trwania ogłoszenia: </p>
								<p>Numer telefonu: {{ $owner->telephone_number }}</p>
							</div>
						</div>
				</div>
			</div>
		</div>

	</div>

</div>


@endsection


@section('scripts')

<script src="/js/advertisementShow.js"></script>
<script src="/js/observedAdvertisement.js"></script>

@endsection