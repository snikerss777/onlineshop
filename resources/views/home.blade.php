@extends('app')

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li class="active">Home</li>
	</ol>

	@if ( session()->has('positive_message') )
    <div class="alert alert-success alert-dismissable">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	{{ session()->get('positive_message') }}
    </div>
@endif

@endsection


@section('content')




<div class="container" ng-controller="CategoriesController">
	<div class="row" ng-init="getCategoriesWithResetStorage()">

		<div class="col-sm-3">
			<div class="panel panel-default">
				<div class="panel-heading">Wybierz kategorie <% 2+2 %></div>

				
					<div class="panel-body" ng-repeat="mainCategory in mainCategories">
						<a href="#" ng-click="getCategoriesWithAdvertisements(mainCategory.id, 0)"> <% mainCategory.name %> </a>
						 
						<ul ng-if="mainCategory.id == categoryIds[0]">
							<li ng-repeat="category in categories[0]"> 
								<a href="#" ng-click="getCategoriesWithAdvertisements(category.id, 1)"> <% category.name %> </a>
								<ul ng-if="category.id == categoryIds[1]">
									<li ng-repeat="category2 in categories[1]">
										<a href="#" ng-click="getCategoriesWithAdvertisements(category2.id, 2)"> <% category2.name %></a>
										<ul ng-if="category2.id == categoryIds[2]"> 
										<!-- ul - //TODO -->
											<li ng-repeat="category3 in categories[2]" >
												<a href="#"  ng-click="getCategoriesWithAdvertisements(category3.id, 3)"> <% category3.name %></a>
												<ul ng-if="category3.id == categoryIds[3]">
													<li ng-repeat="category4 in categories[3]" ><a href="#"  ng-click="getCategoriesWithAdvertisements(category4.id, 4)"> <% category4.name %></a></li>
												</ul>
											</li>	
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</div>

			</div>
		</div>

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Ogłoszenia </div>

				<div class="panel-body">
					<div class="container-fluid">
						<div ng-repeat="advertisement in advertisements" class="row singleAdvertisementContainer">
							
								<div class="col-sm-2">
									<img ng-if="advertisement.src != null" ng-src="/images/<% advertisement.src %>" class="img-responsive">
									<img ng-if="advertisement.src == null" ng-src="/images/default.png" class="img-responsive">
								</div>
								<div class="col-sm-8">
									<a href="/advertisement/<%advertisement.id%>"><h3> <% advertisement.name %> </h3></a>
									<p>Miejscowość: <b><% advertisement.place %></b></p>
								</div>
								<div class="col-sm-2">
									<p>Cena: <b><% advertisement.price %> zł</b></p>
								</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


@endsection
