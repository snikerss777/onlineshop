@extends('app')



@section('styles')

	<link href="{{ asset('/css/advertisementShow.css') }}" rel="stylesheet">

@endsection



@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li class="active"><a  href="" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 0)"> Home </a> </li>
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
							
							<div class="col-sm-6 photoContainer">
								<div id="fullcarousel-example" data-interval="false" class="carousel slide"
						            data-ride="carousel">
						              <div class="carousel-inner">
						              	@if(count($images) == 0)
						              		<div id="photoCarouselId0" class="item  active">
							                  <img src="/images/default.png">          
							                </div>
						              	@else					             
							                @foreach($images as $index => $image)
								                <div id="photoCarouselId{{$index}}" class="item @if($index == 0) active @endif">
								                  <img src="/images/{{$image->src}}">          
								                </div>
							                @endforeach
						                @endif
						              	</div>
						              	@if(count($images) >1)
							              	<a class="left carousel-control" href="#fullcarousel-example" data-slide="prev"><i class="icon-prev fa fa-angle-left"></i></a>
							              	<a class="right carousel-control" href="#fullcarousel-example" data-slide="next"><i class="icon-next fa fa-angle-right"></i></a>
						        		@endif
						        </div>

						        @if(count($images) >1)
							        <div class="row imageContainer">
							        	
							        	<div class="col-xs-1">
								        	@if(count($images) > 3 ) <i class="glyphicon glyphicon-menu-left" onclick="getPreviousPhotos()"></i> @endif
	 									</div>
							        	@foreach($images as $index => $image)
								                
								                <div id="onePhotoContainerId{{$index}}" class="col-xs-2 col-xs-offset-1 onePhotoContainer @if($index >= 3) myImageItem @endif">
	   												<a href="" onclick="changePhoto({{$index}})"><img class="img-responsive" src="/images/{{$image->src}}" /></a>
	 											</div>
	 											
							            @endforeach
							           	<div class="col-xs-1">
								        	@if(count($images) >3 ) <i class="glyphicon glyphicon-menu-right" onclick="getNextPhotos({{count($images)}})"></i>@endif
	 									</div>
							        	
							        </div>
							    @endif

							</div>

							<div class="col-sm-6" style="float:rigth">
								
								<div class="row">
									<div class="col-sm-12">
										<h3  class="right">Cena: <b>{{$advertisement->price}} zł</b> </h3>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12">
										<h3  class="right">Liczba dostępnych egzemplarzy: {{$advertisement->number_of_copies}}</h3>
									</div>
								</div>
 								

 								@if(!Auth::check() || Auth::User()->kind_of_user_id == 6 ) 
									<div class="row right">
										
										<div class="col-sm-12">
											<a class="btn btn-primary btn-lg  buttonDown2 buttonAddToBracket" 
												href="/bracket/{{$advertisement->id}}" >DODAJ DO KOSZYKA</a>
										</div>
									</div>
								@else 
									
									<div class="row">
										<div class="col-sm-12 buttonCol">
											<a style="width:50%; text-align:center;" href="{{ URL::route('advertisement/edit/', ['id' => $advertisement->id]) }}" class="btn btn-primary btn-lg  right buttonDown2 ">Edytuj ogłoszenie</a>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12 buttonCol">
											<a style="width:50%; text-align:center;" href="{{ URL::route('upload/', ['id' => $advertisement->id]) }}" class="btn btn-primary btn-lg  right buttonDown2 ">Zarządzaj zdjęciami</a>
										</div>
									</div>

									<div class="row">
										<div class="col-sm-12 buttonCol">
											<a style="width:50%; text-align:center;" href="{{ URL::route('advertisement/destroy/', ['id' => $advertisement->id]) }}" class="btn btn-warning btn-lg  right buttonDown2 ">Usuń ogłoszenie</a>
										</div>
									</div>

								@endif
							</div>
							

						</div>	


						<div class="row nextRow">
							<div class="col-sm-12">
								<article>
									<h3>Opis:</h3>
									<hr>

									<p>{{ $advertisement->description }}</p>
								</article>
							</div>
						</div>

						<hr>

						<div class="row nextRow">
							<div class="col-sm-6">
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