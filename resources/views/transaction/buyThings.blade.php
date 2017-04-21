@extends('app')

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
  		<li class="active">Zakupione przedmioty</li>
	</ol>

@endsection


@section('content')
	

 
@section('content')

<div class="container" >
	<div class="row" >

		@include('menus.userMenu')

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Zakupione przedmioty</div>
					
				<div class="panel-body" >
					
					
					@include('advertisement.list', ['right_bottom_paragraph' => 'Oczekiwanie na akceptacje przez sprzedawcę', 'link' => '/transaction/',
						'sold' => false])

				</div>
			</div>
		</div>


	</div>

</div>

@endsection
