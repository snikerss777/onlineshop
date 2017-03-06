@extends('app')


@section('styles')

	<link href="{{ asset('/css/user/show.css') }}" rel="stylesheet">

@endsection


@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
  		<li class="active"><a href="/my_account/{{Auth::id()}}">Moje dane</a></li>
	</ol>

@endsection



@section('content')

<div class="container" >
	<div class="row" >

		@include('menus.userMenu')

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Moje dane</div>
				
				<div class="panel-body">
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<ul class="list-group">
									<li class="list-group-item">Imie: {{$user->firstname}}</li>
									<li class="list-group-item">Nazwisko: {{ $user->lastname }}</li>
									<li class="list-group-item">PESEL: {{ $user->pesel }}</li>
									<li class="list-group-item">Email: {{ $user->email }}</li>
									<li class="list-group-item">Data urodzenia: {{ $user->birt_date }}</li>
									<li class="list-group-item">Numer dowodu osobistego: {{ $user->number_of_id_card }}</li>
									<li class="list-group-item">Numer telefonu: {{ $user->telephone_number }}</li>
								</ul>
							</div>


							<div class="col-md-4">
								<ul class="list-group">
									<li class="list-group-item">Numer konta bankowego: 28174746362134571234622345</li>
									<li class="list-group-item">Miejscowość: {{ $user->place }}</li>
									@if(!is_null($user->avenue) )
										<li class="list-group-item">Ulica: {{ $user->avenue }}</li>
									@endif
									<li class="list-group-item">Numer domu: {{ $user->house_number }}</li> 
									@if(!is_null($user->apartment_number) )
										<li class="list-group-item">Ulica: {{ $user->apartment_number }}</li>
									@endif									
									<li class="list-group-item">Kod pocztowy: {{ $user->post_code }}</li>
								</ul>
							</div>
						</div>
						<div class="row">
							<div class="col-md-9">
								<button onclick="window.location='/edit_account/{{$user->id}}'" type="button" class="btn btn-primary">Edytuj dane</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


@endsection
