

				<div class="container-fluid">
					@foreach($advertisements as $advertisement)
						<div class="row singleAdvertisementContainer">
							
								<div class="col-sm-2 myImageDiv" @if(!is_null($advertisement->src)) style="background: url('../images/{{$advertisement->src}}');" @else style="background: url('../images/default.png');" @endif >
									
								</div>

								<div class="col-sm-10">
									<div class="row">
										<div class="col-sm-9">
											<a href="{{$link}}{{$advertisement->id}}"><h3> {{ $advertisement->name }} </h3></a>
											<p>Miejscowość: <b>{{ $advertisement->place }}</b></p>
										</div>
										<div class="col-sm-3 right">
											<p style="float:right">Cena: <b>{{ $advertisement->price }} zł</b></p>
											
											
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<p>Liczba egzemplarzy: <b>{{ $advertisement->number_of_copies }}</b></p>
										</div>
										<div class="col-sm-8"> 

											@if(!$advertisement->is_accepted)
												@if($sold)
													<button style="float:right" class="btn btn-primary" onclick="">{{$right_bottom_paragraph}}</button>
												@else
													<p style="float:right">{{$right_bottom_paragraph}}</p>
												@endif
											@endif
										</div>
									</div>
								</div>

						</div>
					@endforeach
				</div>