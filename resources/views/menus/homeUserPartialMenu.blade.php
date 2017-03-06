

<div class="container" ng-controller="CategoriesController">
	<div class="row" ng-init="getCategories(0,0)">

		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading">Wybierz kategorie <% 2+2 %></div>

				
					<div class="panel-body" ng-repeat="mainCategory in mainCategories">