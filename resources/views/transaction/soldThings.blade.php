@extends('app')

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
  		<li class="active">Sprzedane przedmioty</li>
	</ol>

@endsection


@section('content')
	

 
@section('content')

<div class="container" >
	<div class="row" >

		@include('menus.userMenu')

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Sprzedane przedmioty</div>
					
				<div class="panel-body" >
					
					@include('advertisement.list', ['right_bottom_paragraph' => 'Akceptuj transakcje', 'link' => '/transaction/', 
						'sold' => true])

				</div>
			</div>
		</div>

		




	</div>

</div>

@endsection
