angular.module("ewtg").controller("propertySurroundingsCtrl", function($scope, $routeParams, createAPI, $location){

	function updateProgressBar(progressBar, value) {
		value = Math.round(value);
		progressBar.querySelector(".progress__fill").style.width = `${value}%`;
		progressBar.querySelector(".progress__text").textContent = `${value}%`;
	}
	const myProgressBar = document.querySelector(".progress");
	updateProgressBar(myProgressBar, 40);


	$scope.propertySurroundings = function (property) {
		createAPI.surroundingsInsertUpdate(property)
		.then(function(response){
            if (response.data.error == false) {
                $scope.withData = response.data;
            }
			sweetAlert("Saved!","Click NEXT and go to set Property Pricing","success");
	   	});
	}



	$scope.getIdSurroundings = function () {
		createAPI.getIdSurroundings($routeParams.id)
		.then(function(response){
			
			if (response.data.error == false) {
                $scope.withData = response.data;
            }

			var foundit = response.data;
            if(foundit){
				$scope.property=response.data;
				if ($scope.property.grocery == 1){
					$scope.property.grocery = true;
				} else {
					$scope.property.grocery = false;
				}
				if ($scope.property.wateraccess == 1){
					$scope.property.wateraccess = true;
				} else {
					$scope.property.wateraccess = false;
				}
				if ($scope.property.river == 1){
					$scope.property.river = true;
				} else {
					$scope.property.river = false;
				}
				if ($scope.property.lake == 1){
					$scope.property.lake = true;
				} else {
					$scope.property.lake = false;
				}
				if ($scope.property.ocean == 1){
					$scope.property.ocean = true;
				} else {
					$scope.property.ocean = false;
				}
				if ($scope.property.nationalpark == 1){
					$scope.property.nationalpark = true;
				} else {
					$scope.property.nationalpark = false;
				}
			}
			else{
				$location.path('/');
            }		
		});
	}

});