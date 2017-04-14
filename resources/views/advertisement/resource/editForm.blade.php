						

						<div class="form-group">
							{!! Form::label('delivery_methods', 'Wybierz dostępne metody dostawy: ', ['class' => 'col-sm-4 control-label']) !!}
							<div class="col-sm-8" >
							  	@foreach($deliveryMethods as $deliveryMethod)
								  	<div class="checkbox">
									  	<label>
									  		<input type="checkbox" value="{{$deliveryMethod->id}}" name="deliveryMethods[]" 
									  			{{ ( ( is_array( Input::old('deliveryMethods')) && in_array($deliveryMethod->id, Input::old('deliveryMethods')) ) || (in_array($deliveryMethod->id, $advertisementDeliveryMethods) ) ) ? 'checked' : '' }}>
									  		{{$deliveryMethod->name}}
									  	</label>
									</div>
								@endforeach
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-4 col-md-offset-4">
								<button type="submit" class="btn btn-primary" ng-click="createStorage()">
									{{ $submitButton }}
								</button>
							</div>
						</div>
