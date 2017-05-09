@extends('app')


@section('styles')
	<link rel="stylesheet" type="text/css" href="/css/category.css">
@endsection

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li><a  href="/" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> </li>
  		<li class="active">Usuń kategorię</li>
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
				<div class="panel-heading">Usuń kategorię</div>
				
				<div class="panel-body" >
					
					@include('errors.user')

					@include('categories.form')

					<hr>
					
					<div class="row">
						<label class="col-sm-3 control-label" ng-show="categories.length ==0">Wybierz kategorię, którą chcesz usunąć.</label>
						<label class="col-sm-4 control-label" ng-show="categories.length ==1">Usuń kategorię: <% mainCategories[categoryIds[0]-1].name %></label>
						<label class="col-sm-4 control-label" ng-show="categories.length > 1 ">Usuń kategorię: <span id="categorySpan">AAA</span></label>

					</div>

					<div class="row buttonRow" ng-if="categories.length != 0">
						<div class="col-sm-6">
							<a href="/category/destroy/<% categoryIds[categoryIds.length-1] %>"  class="buttonCategory">Usuń kategorię</a>
						</div>	
					</div>
								

				</div>
			</div>
		</div>
	</div>

@endsection


