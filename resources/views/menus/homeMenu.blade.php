
					

					<div class="panel-body" ng-repeat="mainCategory in mainCategories">
						<a href="#" ng-click="getCategories(mainCategory.id, 0)"> <% mainCategory.name %> </a>
						 
						<ul ng-if="mainCategory.id == categoryIds[0]">
							<li ng-repeat="category in categories[0]"> 
								<a href="#" ng-click="getCategories(category.id, 1)"> <% category.name %> </a>
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
