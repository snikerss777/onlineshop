@extends('app')

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a href="/">Home</a></li>
  		<li class="active">Edytuj dane</li>
	</ol>

@endsection


@section('content')
<div class="container" >
	<div class="row" >

		@if(Auth::user()->kind_of_user_id == 6)

			@include('menus.userMenu')

		@else 

			@include('menus.adminMenu')

		@endif

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Edytuj dane</div>
				
				<div class="panel-body">
					
					@include('errors.user')

					{!! Form::model($user, ['method' => 'PUT', 'action' => ['UserController@update', $user->id] , 'class' => 'form-horizontal']) !!}
						
						@include('user.form', ['submitButton' => 'Zapisz dane'])
					
					{!! Form::close() !!}


				</div>
			</div>
		</div>
	</div>

</div>


@endsection