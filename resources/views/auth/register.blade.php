@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Imie</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="firstname" value="{{ old('firstname') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nazwisko</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">PESEL</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="pesel" value="{{ old('pesel') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Data urodzenia</label>
							<div class="col-md-6">
								<input type="date" class="form-control" name="birth_date" value="{{ old('birth_date') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Numer dowodu osobistego</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="number_of_id_card" value="{{ old('number_of_id_card') }}">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Numer telefonu</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="telephone_number" value="{{ old('telephone_number') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Numer konta bankowego</label>
							<div class="col-md-6">
								<input type="number" class="form-control" name="bank_account_number" value="{{ old('bank_account_number') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Adres email</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Hasło</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Potwierdź hasło</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Miejscowość</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="place" value="{{ old('place') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Ulica</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="avenue" value="{{ old('avenue') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Numer domu</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="house_number" value="{{ old('house_number') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Numer mieszkania</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="apartment_number" value="{{ old('apartment_number') }}">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Kod pocztowy</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="post_code" value="{{ old('post_code') }}">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Utwórz konto
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
