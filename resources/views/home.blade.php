@extends('app')

@section('breadCrumbs')
	
	<ol class="breadcrumb">
  		<li class="active"><a ng-if="categoryIds.length > 0" href="" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)"> Home </a> <span ng-if="categoryIds.length == 0"> Home</span></li>
  		<li ng-if="categoryIds.length != 0"  ng-repeat="cat in mainCategories | filter:{'id': categoryIds[0]}:true"> <a ng-if="categoryIds.length > 1" href="" ng-click="getCategoriesWithAdvertisements(cat.id, 0, 1)" > <% cat.name %> </a> <span ng-if="categoryIds.length == 1"> <% cat.name %></span></li>
  		<li ng-if="categoryIds.length > 1" ng-repeat="cat1 in categories[0] | filter:{'id': categoryIds[1]}:true"> <a ng-if="categoryIds.length > 2" href="" ng-click="getCategoriesWithAdvertisements(cat1.id, 1, 1)" > <% cat1.name %> </a>  <span ng-if="categoryIds.length == 2"> <% cat1.name %></span> </li>
  		<li ng-if="categoryIds.length > 2" ng-repeat="cat2 in categories[1] | filter:{'id': categoryIds[2]}:true" ><a ng-if="categoryIds.length > 3" href="" ng-click="getCategoriesWithAdvertisements(cat2.id, 2, 1)" > <% cat2.name %> </a> <span ng-if="categoryIds.length == 3"> <% cat2.name %></span></li>
  		<li ng-if="categoryIds.length > 3" ng-repeat="cat3 in categories[2] | filter:{'id': categoryIds[3]}:true" > <a ng-if="categoryIds.length > 4" href="" ng-click="getCategoriesWithAdvertisements(cat3.id, 3, 1)" > <% cat3.name %> </a> <span ng-if="categoryIds.length == 4"> <% cat3.name %></span></li>
  		<li ng-if="categoryIds.length > 4" ng-repeat="cat4 in categories[3] | filter:{'id': categoryIds[4]}:true" > <a ng-if="categoryIds.length > 5" href="" ng-click="getCategoriesWithAdvertisements(cat4.id, 4, 1)" > <% cat4.name %> </a> <span ng-if="categoryIds.length == 5"> <% cat4.name %></span></li>		
	</ol>

	@if ( session()->has('positive_message') )
    <div class="alert alert-success alert-dismissable">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    	{{ session()->get('positive_message') }}
    </div>
	@endif

@endsection


@section('content') 




<div  >

	@if ( session()->has('positive_message') )
	<div class="row" ng-init="getCategoriesWithAdvertisements(cat.id, 0, 1)">
	@else
	<div class="row" ng-init="getCategoriesWithResetStorage()">
	@endif
		@include('menus.homeMenu', ['isHome' => 1])

		<div class="col-sm-9">
			<div class="panel panel-default">
				<div class="panel-heading">Przedmioty: </div>

				<div class="panel-body">
					<!-- <div class="container-fluid">
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
					</div> -->
					 	<div ng-repeat="advertisement in advertisements" ng-if="$index % 3 == 0" class="row">
					 		<div class="col-sm-4 advertisementItem" ng-if="advertisements.length > $index && $index <9">
					 			<div class="itemContainer">
					 				<div ng-if="advertisements[$index].src == null" class="myImageContainer" >
					 					<a href="/advertisement/<%advertisements[$index].id%>"><img src="/images/default.png" class="img-responsive"></a>
					 				</div>
					 				<div ng-if="advertisements[$index].src != null" class="myImageContainer" >
					 					<a href="/advertisement/<%advertisements[$index].id%>"><img ng-src="/images/<% advertisements[$index].src %>" class="img-responsive"></a>
					 				</div>
					 				<div class="myTextContainer">
										<div>
											<p class="name"> <span> <a href="/advertisement/<%advertisements[$index].id%>"> <% advertisements[$index].name %></a> </span> <span><% advertisements[$index].price %> zł</span></p>
											<!-- <p class="price" style="margin-bottom:0px">  <% advertisements[$index].price %> zł</p> -->
											<a href="/bracket/<% advertisements[$index].id %>"><button class="">DODAJ DO KOSZYKA</button></a>	
										</div>				 					
					 				</div>

					 			</div>
					 		</div>
					 		<div class="col-sm-4 advertisementItem" ng-if="$index +1 < advertisements.length && $index+1 <9">
					 			<div class="itemContainer">
					 				<div ng-if="advertisements[$index+1].src == null" class="myImageContainer" >
					 					<a href="/advertisement/<%advertisements[$index+1].id%>"><img src="/images/default.png" class="img-responsive"></a>
					 				</div>
					 				<div ng-if="advertisements[$index+1].src != null" class="myImageContainer" >
					 					<a href="/advertisement/<%advertisements[$index+1].id%>"><img ng-src="/images/<% advertisements[$index+1].src %>" class="img-responsive"> </a>
					 				</div>
					 				<div class="myTextContainer">
										<div>
											<p class="name"> <span> <a href="/advertisement/<%advertisements[$index+1].id%>"><% advertisements[$index+1].name %> </a></span>  <span> <% advertisements[$index+1].price %> zł</span></p>
											<!-- <p class="price" style="margin-bottom:0px">  <% advertisements[$index+1].price %> zł</p>	 -->
											<a href="/bracket/<% advertisements[$index+1].id %>"><button class="">DODAJ DO KOSZYKA</button>	</a>
										</div>						 					
					 				</div>

					 			</div>
					 		</div>

					 		<div class="col-sm-4 advertisementItem" ng-if="$index +2 < advertisements.length && $index +2 <9">
					 			<div class="itemContainer">
					 				<div ng-if="advertisements[$index+2].src == null" class="myImageContainer" >
					 					 <a href="/advertisement/<%advertisements[$index+2].id%>"><img src="/images/default.png" class="img-responsive"></a>
					 				</div>
					 				<div ng-if="advertisements[$index+2].src != null" class="myImageContainer" >
					 					 <a href="/advertisement/<%advertisements[$index+2].id%>"><img ng-src="/images/<% advertisements[$index+2].src %>" class="img-responsive"></a>
					 				</div>
					 				<div class="myTextContainer">
										<div>
											<p class="name"><span> <a href="/advertisement/<%advertisements[$index+2].id%>"> <% advertisements[$index+2].name %> </a> </span> <span> <% advertisements[$index+2].price %> zł</span></p>
											<!-- <p class="price" style="margin-bottom:0px">  <% advertisements[$index+2].price %> zł</p>	 -->
											<a href="/bracket/<% advertisements[$index+2].id%>"><button>DODAJ DO KOSZYKA</button></a>	
										</div>						 					
					 				</div>

					 			</div>
					 		</div>


						</div>

						<div class="row" ng-if="allAdvertisements.length >=9">
							
							<div class="col-sm-12">
								<nav aria-label="Page navigation">
								  <ul class="pagination">
								    <li>
								      <a ng-click="getPreviousPage()"  href="" aria-label="Previous">
								        <span aria-hidden="true">&laquo;</span>
								      </a>
								    </li>

								    <li ng-repeat="advertisement in allAdvertisements" ng-if="$index %9 ==0" ng-class="{active: numberOfPagination==getFloor($index)}">
								    	<a ng-click="getAdvertisementsToShow(getFloor($index))"><% getFloor($index) %> </a>
								    </li>
								    
								    <li>
								      <a ng-click="getNextPage()" href="" aria-label="Next">
								        <span aria-hidden="true">&raquo;</span>
								      </a>
								    </li>
								  </ul>
								</nav>
							</div>
							
						</div>
				</div>
			</div>
		</div>
	</div>

</div>


@endsection
