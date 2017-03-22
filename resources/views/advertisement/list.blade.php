

				<div class="container-fluid">
					@foreach($advertisements as $advertisement)
						<div class="row singleAdvertisementContainer">
							
								<div class="col-sm-2 myImageDiv" @if(!is_null($advertisement->src)) style="background: url('../images/{{$advertisement->src}}');" @else style="background: url('../images/default.png');" @endif >
									
								</div>
								<div class="col-sm-8">
									<a href="/advertisement/{{$advertisement->id}}"><h3> {{ $advertisement->name }} </h3></a>
									<p>Miejscowość: <b>{{ $advertisement->place }}</b></p>
								</div>
								<div class="col-sm-2">
									<p>Cena: <b>{{ $advertisement->price }} zł</b></p>
								</div>

						</div>
					@endforeach
				</div>