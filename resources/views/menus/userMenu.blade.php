

<div class="col-sm-3">
			<div class="panel panel-default">
				<div class="panel-heading marginBottom5">Menu główne</div>

				<ul class=" nav nav-pills nav-stacked" >
					<li @if(Request::is('my_account/*'))  class="active" @endif><a href="/my_account/{{Auth::id() }}"><i class="fa fa-home fa-fw"></i>Moje dane</a></li>
	                <!-- <li @if(Request::is('advertisement/create'))  class="active" @endif><a href="/advertisement/create"><i class="fa fa-list-alt fa-fw"></i>Dodaj ogłoszenie</a></li> -->
	                <!-- <li @if(Request::is('getMyAdvertisements'))  class="active" @endif><a href="/getMyAdvertisements"><i class="fa fa-file-o fa-fw"></i>Moje ogłoszenia</a></li> -->
	                <li @if(Request::is('userTransactions/*'))  class="active" @endif><a href="/userTransactions/{{Auth::id()}}"><i class="fa fa-bar-chart-o fa-fw"></i>Zamówienia</a></li>
	                <li @if(Request::is('userProducts/*'))  class="active" @endif><a href="/userProducts/{{Auth::id()}}"><i class="fa fa-bar-chart-o fa-fw"></i>Zakupione przedmioty</a></li>
	                <!-- <li @if(Request::is('transaction/sold'))  class="active" @endif><a href="/transaction/sold"><i class="fa fa-table fa-fw"></i>Sprzedane przedmioty</a></li> -->
	                <li @if(Request::is('bracket'))  class="active" @endif><a href="/bracket"><i class="fa fa-tasks fa-fw"></i>Koszyk</a></li>
	                <li @if(Request::is('edit_account/*'))  class="active" @endif><a href="/edit_account/{{Auth::id()}}"><i class="fa fa-tasks fa-fw"></i>Edytuj konto</a></li>

					
				</ul>

			</div>
</div>