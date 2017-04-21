<!-- 
					
	
					<div class="panel-body" ng-repeat="mainCategory in mainCategories">
						<a href="#" ng-click="getCategories(mainCategory.id, 0)"> <% mainCategory.name %> A</a>
						 
						<ul ng-if="mainCategory.id == categoryIds[0]">
							<li ng-repeat="category in categories[0]"> 
								<a href="#" ng-click="getCategories(category.id, 1)"> <% category.name %> BBBBBB</a>
								<ul ng-if="category.id == categoryIds[1]">
									<li ng-repeat="category2 in categories[1]">
										<a href="#" ng-click="getCategories(category2.id, 2)"> <% category2.name %></a>
										<ul ng-if="category2.id == categoryIds[2]"> 
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
 -->


 <div class="col-sm-3">
			<div class="panel panel-default">
				<div class="panel-heading">Wybierz kategorie <% 2+2 %></div>

				<div class="panel-body" id="mainMenu">
						<div class="myItem" ng-repeat="mainCategory in mainCategories" >
							<a href="#" ng-click="getCategoriesWithAdvertisements(mainCategory.id, 0, {{$isHome}})" class="list-group-item" ng-class="{ 'abc': (categoryIds.length == 1 && categoryIds[0] == mainCategory.id) }"> <% mainCategory.name %> </a>
							 
							<ul class="ulMenu" ng-if="mainCategory.id == categoryIds[0]">
								<li ng-repeat="category in categories[0]"> 
									<a href="#" ng-click="getCategoriesWithAdvertisements(category.id, 1, {{$isHome}})" class="list-group-item" ng-class="{ 'abc': (categoryIds.length == 2 && categoryIds[1] == category.id) }"> <% category.name %>  </a>
									<ul class="ulMenu" ng-if="category.id == categoryIds[1]">
										<li ng-repeat="category2 in categories[1]">
											<a href="#" ng-click="getCategoriesWithAdvertisements(category2.id, 2, {{$isHome}})" class="list-group-item" ng-class="{ 'abc': (categoryIds.length == 3 && categoryIds[2] == category2.id) }"> <% category2.name %></a>
											<ul class="ulMenu" ng-if="category2.id == categoryIds[2]"> 
											<!-- ul - //TODO -->
												<li ng-repeat="category3 in categories[2]" >
													<a href="#"  ng-click="getCategoriesWithAdvertisements(category3.id, 3, {{$isHome}})" class="list-group-item" ng-class="{ 'abc': (categoryIds.length == 4 && categoryIds[3] == category3.id) }"> <% category3.name %></a>
													<ul class="ulMenu" ng-if="category3.id == categoryIds[3]">
														<li ng-repeat="category4 in categories[3]" >
															<a href="#"  ng-click="getCategoriesWithAdvertisements(category4.id, 4, {{$isHome}})" class="list-group-item" ng-class="{ 'abc': (categoryIds.length == 5 && categoryIds[4] == category4.id) }"> <% category4.name %></a>
														</li>
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
		</div>