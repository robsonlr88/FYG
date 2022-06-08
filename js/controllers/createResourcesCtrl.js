angular.module("ewtg").controller("propertyResourcesCtrl", function($scope, $routeParams, createAPI, $location){

	function updateProgressBar(progressBar, value) {
		value = Math.round(value);
		progressBar.querySelector(".progress__fill").style.width = `${value}%`;
		progressBar.querySelector(".progress__text").textContent = `${value}%`;
	}
	const myProgressBar = document.querySelector(".progress");
	updateProgressBar(myProgressBar, 20);

	$scope.propertyResources = function (property) {
		createAPI.resourcesInsertUpdate(property)
		.then(function(response){
            if (response.data.error == false) {
                $scope.withData = response.data;
            }
			sweetAlert("Saved!","Click NEXT and go to Property Surroundings.","success");
	
		})
	}


	$scope.getIdResources = function () {
		createAPI.getIdResources($routeParams.id)
		.then(function(response){
            if (response.data.error == false) {
                $scope.withData = response.data;
            }
			var foundit = response.data;
            if(foundit){
				$scope.property=response.data;
				if ($scope.property.potablewater == 1){
					$scope.property.potablewater = true;
				} else {
					$scope.property.potablewater = false;
				}
				if ($scope.property.toilet == 1){
					$scope.property.toilet = true;
				} else {
					$scope.property.toilet = false;
				}
				if ($scope.property.shower == 1){
					$scope.property.shower = true;
				} else {
					$scope.property.shower = false;
				}
				if ($scope.property.hotshower == 1){
					$scope.property.hotshower = true;
				} else {
					$scope.property.hotshower = false;
				}
				if ($scope.property.kitchen == 1){
					$scope.property.kitchen = true;
				} else {
					$scope.property.kitchen = false;
				}
				if ($scope.property.fridge == 1){
					$scope.property.fridge = true;
				} else {
					$scope.property.fridge = false;
				}
				if ($scope.property.cooking == 1){
					$scope.property.cooking = true;
				} else {
					$scope.property.cooking = false;
				}
				if ($scope.property.eating == 1){
					$scope.property.eating = true;
				} else {
					$scope.property.eating = false;
				}
				if ($scope.property.coffeemachine == 1){
					$scope.property.coffeemachine = true;
				} else {
					$scope.property.coffeemachine = false;
				}
				if ($scope.property.power == 1){
					$scope.property.power = true;
				} else {
					$scope.property.power = false;
				}
				if ($scope.property.campfire == 1){
					$scope.property.campfire = true;
				} else {
					$scope.property.campfire = false;
				}
				if ($scope.property.firewood == 1){
					$scope.property.firewood = true;
				} else {
					$scope.property.firewood = false;
				}
				if ($scope.property.kids == 1){
					$scope.property.kids = true;
				} else {
					$scope.property.kids = false;
				}
				if ($scope.property.pets == 1){
					$scope.property.pets = true;
				} else {
					$scope.property.pets = false;
				}
			}
			else{
				$location.path('/');
            }		
		});
	}

});