@extends('app')



@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
  		<li ><a href="/">{{$advertisement->name}}</a></li>
  		<li class="active">Przeprowadź transakcje</li>
	</ol>

@endsection



 
@section('content')
<div class="container" >
	<div class="row" >

		@include('menus.userMenu')

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Dokonaj zakupu</div>
				
				<div class="panel-body" >
					
					@include('errors.user')

					<h3> {{ $advertisement->name }}</h3>
					<div class="row">
						{!! Form::open(['action' =>'post', 'route' => ['transaction.store']]) !!}
							
							@include('transaction.form')	

						{!! Form::close() !!}
					</div>

				</div>
			</div>
		</div>

	</div>

</div>



@endsection