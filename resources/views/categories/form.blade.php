<div class="form-group row">
							{!! Form::label('category_id', 'Kategoria:', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								<div class="row marginBottom5">
									<div class="col-sm-4">
										<select class="form-control" name="category_id" ng-change="getCategories(select_category_model_1, 0, 0)" ng-model="select_category_model_1">
										  <option ng-repeat="mainCategory in mainCategories" value="<% mainCategory.id %>"> <% mainCategory.name %></option>
										</select>
									</div>
									<div class="col-sm-4">
										<select class="form-control" ng-if="categories[0].length > 0" name="category_id1" ng-change="getCategories(select_category_model_2, 1, 0)" ng-model="select_category_model_2">
										  <option ng-repeat="category1 in categories[0]" value="<% category1.id %>"> <% category1.name %></option>
										</select>
									</div>
									<div class="col-sm-4">
										<select class="form-control" ng-if="categories[1].length > 0" name="category_id2" ng-change="getCategories(select_category_model_3, 2, 0)" ng-model="select_category_model_3">
										  <option ng-repeat="category2 in categories[1]" value="<% category2.id %>"> <% category2.name %></option>
										</select>
									</div>
								</div>
								<div class="row marginBottom5">
									<div class="col-sm-4">									
										<select  class="form-control" ng-if="categories[2].length > 0" name="category_id3" ng-change="getCategories(select_category_model_4, 3, 0)" ng-model="select_category_model_4">
										  <option ng-repeat="category3 in categories[2]" value="<% category3.id %>"> <% category3.name %></option>
										</select>
									</div>
									<div class="col-sm-4">
										<select class="form-control" ng-if="categories[3].length > 0" name="category_id4" ng-change="getCategories(select_category_model_5, 4, 0)" ng-model="select_category_model_5">
										  <option ng-repeat="category4 in categories[3]" value="<% category4.id %>"> <% category4.name %></option>
										</select>
									</div>
								</div>
							</div> 
						</div>




						<!-- 						<div class="form-group row">
							{!! Form::label('category_id', 'Kategoria:', ['class' => 'col-sm-2 control-label']) !!}
							<div class="col-sm-10">
								<div class="row marginBottom5">
									<div class="col-sm-4">
										<select class="form-control" name="category_id" ng-change="getCategories(select_category_model_1.id, 0, 0)" ng-model="select_category_model_1"
											ng-options="mainCategory as mainCategory.name for mainCategory in mainCategories" >
											
										</select>
									</div>
									<div class="col-sm-4">
										<select class="form-control" ng-show="categories[0].length > 0" name="category_id1" ng-change="getCategories(select_category_model_2.id, 1, 0)" ng-model="select_category_model_2"
											ng-options="category1 as category1.name for category1 in categories[0]">
										</select>
									</div>
									<div class="col-sm-4">
										<select class="form-control" ng-show="categories[1].length > 0" name="category_id2" ng-change="getCategories(select_category_model_3.id, 2, 0)" ng-model="select_category_model_3"
										ng-options="category2 as category2.name for category2 in categories[1]">
										</select>
									</div>
								</div>
								<div class="row marginBottom5">
									<div class="col-sm-4">									
										<select  class="form-control" ng-show="categories[2].length > 0" name="category_id3" ng-change="getCategories(select_category_model_4.id, 3, 0)" ng-model="select_category_model_4"
											ng-options="category3 as category3.name for category3 in categories[2]">
										  
										</select>
									</div>
									<div class="col-sm-4">
										<select class="form-control" ng-show="categories[3].length > 0" name="category_id4" ng-change="getCategories(select_category_model_5.id, 4, 0)" ng-model="select_category_model_5"\
											ng-options="category4 as category4.name for category4 in categories[3]">
										</select>
									</div>
								</div>
							</div> 
						</div> -->