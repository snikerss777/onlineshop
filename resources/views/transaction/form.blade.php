

	<!-- <div class="form-group">
		{!! Form::label('price', 'Cena:', ['class' => 'col-sm-12 control-label']) !!}
		<div class="col-md-8">
			{!! Form::input('number', 'price', null, ['class' => 'form-control']) !!}
		</div> 
	</div> -->

	<div class="col-sm-6">
		<div class="form-group">
			{!! Form::label('price', 'Cena: '.$advertisement->price. 'zł', ['class' => 'control-label']) !!}
		</div>

		<div class="form-group row">
	
			{!! Form::label('number_of_copies', 'Liczba egzemplarzy:', ['class' => 'col-sm-5 col-form-label', 'for' =>'number_of_copies_id']) !!}

			<div class="col-sm-6">
				{!! Form::input('number', 'number_of_copies', 1, ['class' => 'form-control', 'id'=>'number_of_copies_id']) !!}
			</div>
		</div>

		<div class="form-group row">
			{!! Form::label('deliverry_method_id', 'Sposób dostawy:', ['class' => 'col-sm-5 col-form-label']) !!}
			<div class="col-sm-6">
				{!! Form::select('deliverry_method_id', $deliveryMethods, null, ['class' => 'form-control']) !!}
			</div>
		</div>

		<div class="form-group">
			{!! Form::label('account_number', 'Numer konta bankowego: '. $advertisement->account_number, ['class' => 'control-label']) !!}
		</div>


	</div>

	<div class="col-sm-6">
		<div class="form-group">
				{!! Form::label('Sprzedawca: ', 'Sprzedawca: '. $owner->firstname . ' ' . $owner->lastname, ['class' => 'control-label']) !!}
				{!! Form::hidden('owner_id', $owner->id) !!}
				{!! Form::hidden('buyer_id', Auth::id()) !!}
		</div>		
		<div class="form-group">
				{!! Form::label('advertisement_id', 'Numer ogłoszenia: '.$advertisement->id, ['class' => 'control-label']) !!}
				{!! Form::hidden('advertisement_id', $advertisement->id) !!}
		</div>

		<div class="form-group">
			{!! Form::label('time_to_end_of_advertisement', 'Pozostały czas trwania ogłoszenia:' , ['class' => 'control-label']) !!}
		</div>

		<div class="form-group">
				<h3>Całkowity koszt: {{ $advertisement->price}} zł</h3>
		</div>

		<div class="form-group buttonDown2">
			<button type="submit" class="btn btn-primary buttonDown2">Dokonaj zakupu</button>
		</div>
	</div>

