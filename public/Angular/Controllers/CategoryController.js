
angular.module('app').controller('CategoriesController', ['$scope', '$http', function($scope, $http){

		$scope.categories= [];
		$scope.levelId = 0;
		$scope.categoryIds = [];

		$scope.mainCategories;

		$scope.getCategories = function(categoryId, levelId){
			console.log("category id " +categoryId);
			$http.get('/getCategories/' + categoryId)
				.then(function(response) { 

				   	if(levelId == 0){
				   		$scope.levelId = levelId;
				   		$scope.categories = [];
				   		$scope.categoryIds = [];
				   	}
				    else if(levelId <= $scope.levelId){
				    	$scope.levelId = levelId;
				    	$scope.categories.splice(levelId+1, ($scope.categories.length - levelId - 1));
				    	$scope.categoryIds.splice(levelId+1, ($scope.categoryIds.length - levelId - 1));
				    }

				    if(categoryId == 0){
				    	$scope.mainCategories = response.data;
				    }

				    else{				  
				    	$scope.categoryIds[$scope.levelId] = categoryId;
						$scope.categories[$scope.levelId] = response.data;
				    	
				    	$scope.levelId ++;

				    }
				   
				})
		}
	}]);