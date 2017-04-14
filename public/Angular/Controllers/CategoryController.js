
angular.module('app').controller('CategoriesController', ['$scope', '$http', '$localStorage' , function($scope, $http, $localStorage){

		$scope.categories= [];
		$scope.levelId = 0;
		$scope.categoryIds = [];

		$scope.mainCategories;

		$scope.$storage = $localStorage.$default({
			
		});


		$scope.createStorage = function(){
			$scope.$storage.mainCategoriesStorage = $scope.mainCategories; 
			$scope.$storage.categoriesStorage = $scope.categories; 
			$scope.$storage.levelIdStorage = $scope.levelId; 
			$scope.$storage.categoryIdsStorage = $scope.categoryIds; 
		};

		$scope.createStorageHome = function(){
			$scope.$storage.mainCategoriesStorageHome = $scope.mainCategories; 
			$scope.$storage.categoriesStorageHome = $scope.categories; 
			console.log('TEST');
			console.log($scope.$storage.categoriesStorageHome);
			console.log($scope.categories);

			$scope.$storage.levelIdStorageHome = $scope.levelId; 
			$scope.$storage.categoryIdsStorageHome = $scope.categoryIds; 
		};

		$scope.getAdvertisements = function(categoryId, isHome){
			$http.get('/getAdvertisements/'+categoryId)
				.then(function(response) {
					$scope.advertisements = response.data;
					$scope.$storage.advertisementsStorageHome = $scope.advertisements;
					if(isHome == 0)
						window.location.replace('/');
				});
		}
		
		$scope.getCategories = function(categoryId, levelId, home){
			console.log('categoryId '+categoryId + "  levelId -"+ levelId + "home - "+ home);
			if(categoryId !== null){
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

					    if(categoryId == 0 || angular.isUndefined(categoryId)){
					    	$scope.mainCategories = response.data;
					    }
					    else {				
					    	$scope.categoryIds[$scope.levelId] = categoryId;
							$scope.categories[$scope.levelId] = response.data;
					    	
					    	$scope.levelId ++;

					    }

					    if(home == 1){
					    	$scope.createStorageHome();
					    }
					    //console.log($scope.categories);
					 //   	console.log("category id " +categoryId + " " + $scope.categoryIds.length);
						// console.log($scope.categories);
					 //   	console.log($scope.categoryIds);
					 console.log('AAAAAAAAA');

					});
				}
		}


		$scope.getCategoriesWithStorage = function(isEdit, categoryId){
			console.log($scope.$storage.levelIdStorage + "   = TEST  // isEdit = "+isEdit+ "  // categoryId= "+categoryId);
			
			if(isEdit == 1){
				$scope.getEditCategories(categoryId);
			}
			else if(angular.isUndefined($scope.$storage.levelIdStorage) || $scope.$storage.levelIdStorage ==0){
				$scope.getCategories(0,0);
			}
			else{

				$scope.mainCategories = $scope.$storage.mainCategoriesStorage;
				$scope.categories =  $scope.$storage.categoriesStorage;
				$scope.levelId =  $scope.$storage.levelIdStorage;
				$scope.categoryIds = $scope.$storage.categoryIdsStorage;

				setModels();
			}
			console.log($scope.levelId + " LevelID");
		}

		function setModels (){
			console.log("Set mocels");

				$scope.select_category_model_1 = $scope.categoryIds[0];
				$scope.select_category_model_2 = $scope.categoryIds[1];
				$scope.select_category_model_3 = $scope.categoryIds[2];
				$scope.select_category_model_4 = $scope.categoryIds[3];
				$scope.select_category_model_5 = $scope.categoryIds[4];
				console.log($scope.select_category_model_1);

		}

		$scope.getEditCategories = function(categoryId){
			//$scope.getCategories(0,0);
				$http.get('/getEditCategories/'+categoryId)
					.then(function(response){
						
						console.log(response );

						console.log(response.data.categoryIds);
						$scope.mainCategories = response.data.mainCategories;
						$scope.categories =  response.data.categories;
						$scope.levelId =  response.data.levelId;
						$scope.categoryIds = response.data.categoryIds;
						console.log(response.data.levelId);
						setModels();
				});

		}


		$scope.getCategoriesWithResetStorage = function(){
			if(angular.isUndefined($scope.$storage.levelIdStorageHome)){
				$scope.getCategories(0,0);
				$scope.getAdvertisements(0, 1);
			}
			else{
				$scope.mainCategories = $scope.$storage.mainCategoriesStorageHome;
				$scope.categories =  $scope.$storage.categoriesStorageHome;
				$scope.levelId =  $scope.$storage.levelIdStorageHome;
				$scope.categoryIds = $scope.$storage.categoryIdsStorageHome;
				$scope.advertisements = $scope.$storage.advertisementsStorageHome;
				//console.log("$scope.$storage.mainCategoriesStorageHome = " + $scope.$storage.mainCategoriesStorageHome;);
				

			}
			$scope.$storage.mainCategoriesStorage = [];
			$scope.$storage.categoriesStorage = [];
			$scope.$storage.levelIdStorage = 0;
			$scope.$storage.categoryIdsStorage = [];

		}

		$scope.getCategoriesWithAdvertisements = function(categoryId, levelId , isHome){
			console.log(isHome + " = isHome");
			$scope.getCategories(categoryId, levelId, 1);
			$scope.getAdvertisements(categoryId, isHome);
		}

	}]);