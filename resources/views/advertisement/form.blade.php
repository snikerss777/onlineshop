						
						

						<div class="form-group">
							{!! Form::label('name', 'Nazwa:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::text('name', null, ['class' => 'form-control']) !!}
							</div> 
						</div>

						<div class="form-group">
							{!! Form::label('description', 'Opis:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
							</div> 
						</div>

						<!-- //TODO kolumny -->
						<div class="form-group">
							{!! Form::label('price', 'Cena:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::input('number', 'price', null, ['class' => 'form-control']) !!}
							</div> 
						</div>


						<div class="form-group">
							{!! Form::label('number_of_copies', 'Liczba egzemplarzy:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::input('number','number_of_copies', null, ['class' => 'form-control']) !!}
							</div> 
						</div>

						<div class="form-group">
							{!! Form::label('create_year', 'Rok produkcji:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::input('number','create_year', null, ['class' => 'form-control']) !!}
							</div> 
						</div>


						<div class="form-group">
							{!! Form::label('advertisement_duration', 'Czas trwania ogłoszenia:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::input('number','advertisement_duration', null, ['class' => 'form-control']) !!}
							</div> 
						</div>
						
						<div class="form-group">
							{!! Form::label('place', 'Miejscowość:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::text('place', null, ['class' => 'form-control']) !!}
							</div> 
						</div>

						<div class="form-group">
							{!! Form::label('account_number', 'Numer konta bankowego:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::input('number', 'account_number', Auth::User()->bank_account_number, ['class' => 'form-control']) !!}
							</div> 
						</div>

						<div class="form-group">
							{!! Form::label('used', 'Czy używany:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								{!! Form::select('used', array(1 => 'Tak', 0 => 'Nie'), null, ['class' => 'form-control']) !!}
							</div> 
						</div>


						<div class="form-group">
							{!! Form::label('category_id', 'Kategoria:', ['class' => 'col-md-2 control-label']) !!}
							<div class="col-md-8">
								<select name="category_id" ng-change="getCategories(select_category_model_1, 0, 0)" ng-model="select_category_model_1">
								  <option ng-repeat="mainCategory in mainCategories" value="<% mainCategory.id %>"> <% mainCategory.name %></option>
								</select>

								<select ng-if="categories[0].length > 0" name="category_id1" ng-change="getCategories(select_category_model_2, 1, 0)" ng-model="select_category_model_2">
								  <option ng-repeat="category1 in categories[0]" value="<% category1.id %>"> <% category1.name %></option>
								</select>

								<select ng-if="categories[1].length > 0" name="category_id2" ng-change="getCategories(select_category_model_3, 2, 0)" ng-model="select_category_model_3">
								  <option ng-repeat="category2 in categories[1]" value="<% category2.id %>"> <% category2.name %></option>
								</select>

								<select ng-if="categories[2].length > 0" name="category_id3" ng-change="getCategories(select_category_model_4, 3, 0)" ng-model="select_category_model_4">
								  <option ng-repeat="category3 in categories[2]" value="<% category3.id %>"> <% category3.name %></option>
								</select>

								<select ng-if="categories[3].length > 0" name="category_id4" ng-change="getCategories(select_category_model_5, 4, 0)" ng-model="select_category_model_5">
								  <option ng-repeat="category4 in categories[3]" value="<% category4.id %>"> <% category4.name %></option>
								</select>

							</div> 
						</div>

						<div class="form-group">
							<div class="col-md-2 col-md-offset-2">
								<button type="submit" class="btn btn-primary" ng-click="createStorage()">
									Dodaj ogłoszenie
								</button>
							</div>
						</div>
