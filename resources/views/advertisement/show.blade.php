@extends('app')

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li ><a href="/">Home</a></li>
  		<li class="active">{{ $advertisement->name }}</li>
	</ol>

@endsection


@section('content')

	Hello show {{ $advertisement->name }}

@endsection