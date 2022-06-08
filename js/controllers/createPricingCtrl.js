angular.module("ewtg").controller("propertyPricingCtrl", function($scope, $routeParams, createAPI, $location){


	function updateProgressBar(progressBar, value) {
		value = Math.round(value);
		progressBar.querySelector(".progress__fill").style.width = `${value}%`;
		progressBar.querySelector(".progress__text").textContent = `${value}%`;
	}
	const myProgressBar = document.querySelector(".progress");
	updateProgressBar(myProgressBar, 60);

	$scope.propertyPricing = function (property) {
		createAPI.pricingInsertUpdate(property)
		.then(function(response){
            if (response.data.error == false) {
                $scope.withData = response.data;
            }
			sweetAlert("Saved!","Click NEXT and to add your pictures.","success");
			
	   	});
	}

	$scope.getIdPricing = function () {
		createAPI.getIdPricing($routeParams.id)
		.then(function(response){

            if (response.data.error == false) {
                $scope.withData = response.data;
            }

			var foundit = response.data;
            if(foundit){
				$scope.property=response.data;
				if ($scope.property.person == 1){
					$scope.property.person = true;
				} else {
					$scope.property.person = false;
				}
				if ($scope.property.otherfees == 1){
					$scope.property.otherfees = true;
				} else {
					$scope.property.otherfees = false;
				}	
			}
			else{
				$location.path('/');
            }		
		});
	}

});