@extends('app')



@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
  		<li ><a href="/advertisement/{{$advertisement->advertisement_id}}">{{$advertisement->name}}</a></li>
  		@if(Auth::id() == $buyer->id)
			<li class="active">Dane zakupu</li>
		@else
			<li class="active">Dane sprzedaży</li> 
		@endif 
	</ol>

@endsection



 
@section('content')
<div class="container" >
	<div class="row" >

		@include('menus.userMenu')

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">
					@if(Auth::id() == $buyer->id)
						Dane zakupu dla ogłoszenia: 
					@else
						Dane sprzedaży przedmiotu z ogłoszenia:  
					@endif 
					<a href="/advertisement/{{$advertisement->advertisement_id}}">{{$advertisement->name}}</a>
				</div>
				
				<div class="panel-body" >
					<div class="row">
						<div class="col-sm-6">
							<img src="/images/{{$advertisement->src}}" class="img-responsive">
						</div>
						<div class="col-sm-6">
							<h4 class="textAlignOnRight marginBottom5">Cena: {{$advertisement->price}} zł</h4>
							<h4 class="textAlignOnRight marginBottom5">Liczba egzemplarzy: {{$advertisement->number_of_copies}}</h4>
							@if(Auth::id() == $buyer->id)
								<h4 class="textAlignOnRight marginBottom5">Sprzedawca: {{$owner->firstname}} {{$owner->lastname}}</h4>
							@else
								<h4 class="textAlignOnRight marginBottom5">Kupujący: {{$buyer->firstname}} {{$buyer->lastname}}</h4>
							@endif
							<h4 class="textAlignOnRight marginBottom5">Data transakcji: {{$advertisement->created_at}}</h4>
							<h4 class="textAlignOnRight marginBottom5">Sposób dostawy: {{$deliveryMethod->name}}</h4>
							
							 
							@if(Auth::id() == $buyer->id)
								<h4 class="textAlignOnRight marginBottom5">Status transakcji: @if($advertisement->is_accepted == 1) Zaakceptowana @else Do akceptacji @endif </h4>
							@else
								@if($advertisement->is_accepted == 1)
									<h4 class="textAlignOnRight marginBottom5">Status transakcji: Zaakceptowana</h4>
								@else
									<button class="btn btn-primary onRight marginBottom5" onclick="acceptTransaction({{$advertisement->id}})" >Akceptuj transakcję</button>
								@endif
							@endif 
							
							<a href="{{ URL::route('goToAdvertisement/', ['id' => $advertisement->advertisement_id]) }}" class="btn btn-primary  onRight marginRight10">Przejdź do ogłoszenia</a>
						</div>
					</div>

				</div>
			</div>
		</div>

	</div>

</div>



@endsection

@section('scripts')
	<script type="text/javascript" src="/js/transactionShow.js"></script>
@endsection