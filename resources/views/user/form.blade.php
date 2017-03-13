						
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">

							{!! Form::label('firstname', 'Imię:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('firstname', null, ['class' => 'form-control']) !!}
							</div> 
						</div>

						<div class="form-group">
							{!! Form::label('lastname', 'Nazwisko:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('lastname', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('pesel', 'PESEL:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::input('number', 'pesel', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('birth_date', 'Data urodzenia:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::input('date', 'birth_date', null, ['class' => 'form-control', 'placeholder' => 'Date']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('number_of_id_card', 'Numer dowodu osobistego:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('number_of_id_card', null, ['class' => 'form-control']) !!}
							</div>
						</div>


						<div class="form-group">
							{!! Form::label('telephone_number', 'Numer telefonu:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::input('number', 'telephone_number', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('bank_account_number', 'Numer konta bankowego:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::input('number','bank_account_number', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('email', 'Adres email:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::input('email','email', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('password', 'Nowe Hasło:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::password('password',  ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('password_confirmation', 'Potwierdź hasło:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::password('password_confirmation',  ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('place', 'Miejscowość:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('place', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('avenue', 'Ulica:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('avenue', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('house_number', 'Numer domu:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('house_number', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('apartment_number', 'Numer mieszkania:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('apartment_number', null, ['class' => 'form-control']) !!}
							</div>
						</div>


						<div class="form-group">
							{!! Form::label('post_code', 'Kod pocztowy:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('post_code', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{$submitButton}}
								</button>
							</div>
						</div>
