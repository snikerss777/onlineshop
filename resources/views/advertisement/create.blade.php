@extends('app')



@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
  		<li class="active">Dodaj ogłoszenie</li>
	</ol>

@endsection



 
@section('content')
<div class="container" >
	<div class="row" >

		@include('menus.adminMenu')

		<div class="col-md-9">
			<div class="panel panel-default" ng-controller="CategoriesController">
				<div class="panel-heading">Dodaj ogłoszenie</div>
				
				<div class="panel-body" ng-init="getCategoriesWithStorage(0,0)">
					
					@include('errors.user')

					{!! Form::open(['method' => 'POST', 'action' => ['AdvertisementController@store'] , 'files'=> true, 'class' => 'form-horizontal']) !!}

						@include('advertisement.form')

					{!! Form::close() !!}

				</div>
			</div>
		</div>

	</div>

</div>



@endsection