@extends('app')



@section('styles')

	<link href="{{ asset('/css/uploadImage.css') }}" rel="stylesheet">

@endsection




@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a href="/">Home</a></li>
  		<li><a href="/advertisement/{{$advertisement->id}}">{{$advertisement->name}}</a></li>
  		<li class="active">Dodaj zdjęcia do ogłoszenia</li>

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

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">Dodaj zdjęcia do ogłoszenia: {{ $advertisement->name }}</div>
				
				<div class="panel-body" >
					
					@include('errors.user')

					<div id="wrapper">
							

					    <!-- <h1>Dodaj zdjęcia do ogłoszenia (Maksymalnie 8)</h1> -->
					        {!! Form::open([ 'route' => [ 'image.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 
				                	'class' => 'dropzone', 'id' => 'book-image' ]) !!}
					        	<div>
					                	
					            	 <h3>Dodaj zdjęcie</h3>
					        	</div>
					        	<input type="hidden" value="{{$advertisement->id}}" name="advertisement_id">
					        {!! Form::close() !!}
					        
					        <br> <br>

					        <input type="hidden" value="{{count($images)}}" id="count_of_images">

					        @if(count($images))
								<h3>Aktualne zdjęcia:</h3>
								<div>
									@foreach($images as $image)
										  <div id="img{{$image->id}}" class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
										  		
										  		<a href=""><i  class="glyphicon glyphicon-link myIcon" id="changeIcon" onclick="setAsIcon({{$image->id}})"></i></a>
										  		<a href=""><i  class="glyphicon glyphicon-remove myIcon" id="removeIcon" onclick="removeImage({{$image->id}})"></i></a>
								                <img id="imgId{{$image->id}}" src="/images/{{$image->src}}" class="img-responsive @if($advertisement->photo_id == $image->id) iconImage @endif">
								          </div>
									@endforeach
								</div>
							@endif
					        <br> <br>


			      	</div>
			      	<br>
			      	
			      	<!-- <button type="submit" class="btn btn-primary" id="submit-all">Przejdź do strony głównej</button> -->


				</div>
			</div>
		</div>

		




	</div>

</div>


@endsection




@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

<script src="/js/upload.js"></script>

@endsection