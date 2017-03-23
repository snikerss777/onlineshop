@extends('app')



@section('styles')

	<link href="{{ asset('/css/advertisementShow.css') }}" rel="stylesheet">

@endsection



@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
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
	<div class="row" >

		@include('menus.userMenu')

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
								<h4  class="right">Liczba dostępnych egzemplarzy: {{$advertisement->number_of_copies}}</h4>
								@if(Auth::id() != $owner->id) <button class="btn btn-primary btn-lg  right buttonDown2" onclick="goToCreateTransaction({{$advertisement->id}})">Kup teraz</button>
								@else 
									<button class="btn btn-primary btn-lg  right buttonDown2" onclick="goToEditAdvertisement({{$advertisement->id}})">Edytuj ogłoszenie</button><br>
									<button class="btn btn-primary btn-lg  right buttonDown2" onclick="goToUploadPhoto({{$advertisement->id}})">Zarządzaj zdjęciami</button>

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
											@if(Auth::id() == $owner->id) 
												<button class="btn btn-primary btn-lg buttonDown right"  onclick="goToUploadPhoto({{$advertisement->id}})">Zarządzaj zdjęciami</button>
												<button class="btn btn-primary btn-lg buttonDown right buttonRight"  onclick="goToEditAdvertisement({{$advertisement->id}})">Edytuj ogłoszenie</button>
											@else
												<button class="btn btn-primary btn-lg buttonDown right " onclick="goToCreateTransaction({{$advertisement->id}})">Kup teraz</button>
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

@endsection