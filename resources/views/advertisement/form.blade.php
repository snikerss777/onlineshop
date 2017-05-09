						
						


						<div class="form-group">
							{!! Form::label('name', 'Nazwa:', ['class' => 'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
								{!! Form::text('name', null, ['class' => 'form-control']) !!}
							</div> 
						</div>

						<div class="form-group">
							{!! Form::label('description', 'Opis:', ['class' => 'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
								{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
							</div> 
						</div>

						<!-- //TODO kolumny -->
						<div class="form-group">
							{!! Form::label('price', 'Cena:', ['class' => 'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
								{!! Form::input('number', 'price', null, ['class' => 'form-control']) !!}
							</div> 
						</div>


						<div class="form-group">
							{!! Form::label('number_of_copies', 'Liczba egzemplarzy:', ['class' => 'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
								{!! Form::input('number','number_of_copies', null, ['class' => 'form-control']) !!}
							</div> 
						</div>


						<div class="form-group">
							{!! Form::label('category_id', 'Kategoria:', ['class' => 'col-sm-4 control-label']) !!}
							<div class="col-sm-8">
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

						@if(!isset($advertisement))
							@include('advertisement.resource.createForm', ['submitButton' => 'Dodaj ogłoszenie'])
						@else 
							@include('advertisement.resource.editForm', ['submitButton' => 'Zapisz zmiany'])
						@endif

					


