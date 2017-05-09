@extends('app')


@section('styles')
<link rel="stylesheet" type="text/css" href="/css/category.css">

@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li class="active">Dodaj kategorię</li>
	</ol>

	@if ( session()->has('positive_message') )
    <div class="alert alert-success alert-dismissable">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	{{ session()->get('positive_message') }}
    </div>
    @endif


@endsection

@section('content')

	<div class="row" >

		@include('menus.adminMenu')

		<div class="col-sm-9" ng-init="getCategories(cat.id, 0, 1)">
			<div class="panel panel-default">
				<div class="panel-heading">Dodaj kategorię</div>
				
				<div class="panel-body" >
					@include('errors.user')

					@include('categories.form')

					<hr>
					
					{!! Form::open(['action' =>'post', 'action' => ['CategoryController@store']]) !!}
					<div class="row">
						<label class="col-sm-3 control-label" ng-show="categories.length ==0">Dodaj nową kategorię:</label>
						<label class="col-sm-4 control-label" ng-show="categories.length ==1">Dodaj nową podkategorię dla kategorii: <% mainCategories[categoryIds[0]-1].name %></label>
						<label class="col-sm-4 control-label" ng-show="categories.length > 1 && categories.length <5">Dodaj nową podkategorię dla kategorii: <span id="categorySpan">AAA</span></label>

						<label class="col-sm-4 control-label" ng-show="categories.length == 5">Nie możesz dodać kolejnej podkategorii</label>
						<div class="col-sm-4" ng-show="categories.length != 5">
								<input  class="form-control"  name="newCategory">
								<input type="hidden" class="form-control" value="<% categoryIds[categoryIds.length-1] %>" name="above_category" >		
						</div>
					</div>

					<div class="row buttonRow" ng-if="categories.length != 5">
						<div class="col-sm-6">
							<button type="submit"  class="buttonCategory">Dodaj kategorię</button>
						</div>	
					</div>

					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

@endsection


