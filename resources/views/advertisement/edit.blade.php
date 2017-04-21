@extends('app')



@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
  		<li ><a href="/advertisement/{{$advertisement->id}}">{{$advertisement->name}}</a></li>
  		<li class="active">Edytuj ogłoszenie</li>
	</ol>

@endsection



 
@section('content')
<div class="container" >
	<div class="row" >

		@include('menus.adminMenu')

		<div class="col-md-9">
			<div class="panel panel-default" ng-controller="CategoriesController">
				<div class="panel-heading">Edytuj ogłoszenie: {{$advertisement->name}}</div>
				
				<div class="panel-body" ng-init="getCategoriesWithStorage(1, {{$advertisement->category_id}})">
					
					@include('errors.user')

					{!! Form::model($advertisement, ['method' => 'PATCH', 'action' => ['AdvertisementController@update', $advertisement->id] , 'files'=> true, 'class' => 'form-horizontal']) !!}

						@include('advertisement.form')

					{!! Form::close() !!}

				</div>
			</div>
		</div>

	</div>

</div>



@endsection