@extends('app')

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li class="active"><a href="#">Home</a></li>
	</ol>

@endsection



@section('content')

<div class="container" ng-controller="CategoriesController">
	<div class="row" ng-init="getCategories(0,0)">

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Wybierz kategorie <% 2+2 %></div>

				
					<div class="panel-body" ng-repeat="mainCategory in mainCategories">
						<a href="#" ng-click="getCategories(mainCategory.id, 0)"> <% mainCategory.name %> </a>
						 
						<ul ng-if="mainCategory.id == categoryIds[0]">
							<li ng-repeat="category in categories[0]"> 
								<a href="#" ng-click="getCategories(category.id, 1)"> <% category.name %> </a>
								<ul ng-if="category.id == categoryIds[1]">
									<li ng-repeat="category2 in categories[1]">
										<a href="#" ng-click="getCategories(category2.id, 2)"> <% category2.name %></a>
										<ul ng-if="category2.id == categoryIds[2]"> 
										<!-- ul - //TODO -->
											<li ng-repeat="category3 in categories[2]" >
												<a href="#"  ng-click="getCategories(category3.id, 3)"> <% category3.name %></a>
												<ul ng-if="category3.id == categoryIds[3]">
													<li ng-repeat="category4 in categories[3]" ><a href="#"  ng-click="getCategories(category4.id, 4)"> <% category4.name %></a></li>
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

		<div class="col-md-9">
			<div class="panel panel-default">
				<div class="panel-heading">asddas</div>

				<div class="panel-body">
					
				</div>
			</div>
		</div>
	</div>

</div>


@endsection
