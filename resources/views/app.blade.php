<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/home.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	@yield('styles')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body ng-app="app">
	<nav class="navbar navbar-default" >
		<div class="container-fluid" id="horizontalMenu">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Online shop <% 2+2 %></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" ng-controller="CategoriesController">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">Strona główna</a></li>
					<li><a href="{{ url('/bracket') }}">Koszyk</a></li>
					@if(Auth::guest())
					<li><a href="{{ url('/') }}">Kontakt</a></li>
					@else
						<li><a href="{{ url('/advertisement/create') }}">Dodaj ogłoszenie</a></li>
					@endif
				</ul>

				<form class="navbar-form navbar-left" id="centerd-navbar">
				      <div class="form-group">
				        <input type="text" class="form-control" placeholder="Szukaj w sklepie" id="phrase">
				      </div>
				      <button class="btn searchButton" ng-click="getAdvertisementsBySearched()"><span class="glyphicon glyphicon-search"></span></button>
				</form>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Zaloguj</a></li>
						<li><a href="{{ url('/auth/register') }}">Rejestracja</a></li>
					@else
						<li><a href="/my_account/{{Auth::id()}}"  aria-expanded="false">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</a></li>
						<li><a href="{{ url('/auth/logout') }}">Wyloguj</a></li>
						<!-- <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Wyloguj</a></li>
							</ul>
						</li> -->
					@endif
				</ul>
			</div> 
		</div>
	</nav>
	
	<div class="container" ng-controller="CategoriesController">
		@yield('breadCrumbs')


		@yield('content')

	</div>

	

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.2/angular.min.js"></script>
	<script src="/Angular/Controllers/MainController.js"></script>
	<script src="/Angular/Controllers/CategoryController.js"></script>
    <script src="https://rawgithub.com/gsklee/ngStorage/master/ngStorage.js"></script> 

    @yield('scripts')
    
</body>
</html>
