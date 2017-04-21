<div class="col-sm-3">
			<div class="panel panel-default">
				<div class="panel-heading marginBottom5">Menu główne</div>

				<ul class=" nav nav-pills nav-stacked" >
					<li @if(Request::is('my_account/*'))  class="active" @endif><a href="/my_account/{{Auth::id() }}"><i class="fa fa-home fa-fw"></i>Moje dane</a></li>
	               	<!-- <li @if(Request::is('getMyAdvertisements'))  class="active" @endif><a href="/getMyAdvertisements"><i class="fa fa-file-o fa-fw"></i>Ogłoszenia</a></li> -->

	                <li @if(Request::is('advertisement/create'))  class="active" @endif><a href="/advertisement/create"><i class="fa fa-list-alt fa-fw"></i>Dodaj ogłoszenie</a></li>
	                <!-- <li @if(Request::is('transaction/done'))  class="active" @endif><a href="/transaction/done"><i class="fa fa-bar-chart-o fa-fw"></i>Zakupione przedmioty</a></li> -->
	                <li @if(Request::is('admin/transactions'))  class="active" @endif><a href="/admin/transactions"><i class="fa fa-table fa-fw"></i>Zamówienia</a></li>
	                <li @if(Request::is('archive/transactions'))  class="active" @endif><a href="/archive/transactions"><i class="fa fa-table fa-fw"></i>Archiwum</a></li>

	                <li @if(Request::is('edit_account/*'))  class="active" @endif><a href="/edit_account/{{Auth::id()}}"><i class="fa fa-tasks fa-fw"></i>Edytuj konto</a></li>

					
				</ul>

			</div>
</div>