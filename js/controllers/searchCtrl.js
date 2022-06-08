angular.module("ewtg").controller("searchCtrl", function($scope, $http, $routeParams, searchAPI, loginService){

	$scope.searchProperty = function (resources, surroundings, pricing) {

		$http.post("backend/search.php", {resources, surroundings, pricing})
		.then(function(response){
			$scope.properties=response.data.records;
		});	
	}


	$scope.showProperties = function () {
		$http.get("backend/properties.php")
		.then(function(response){
			$scope.properties=response.data.records;
		});	
	}

	searchAPI.getIdSearch($routeParams.id)
		.then(function(response){
		$scope.propertyResult=response.data.property;
	});	

	searchAPI.propertyView($routeParams.id)
		.then(function(response){
		$scope.property=response.data;
	});	

	$scope.propertyContactDetails = function () {

		searchAPI.propertyView($routeParams.id)
			.then(function(response){
				$scope.property=response.data;
		});	

		var blockUnloggedUsers = loginService.islogged();
        blockUnloggedUsers.then(function(response){
            if(response.data != "authentified"){

				Swal.fire({
					title: 'Please <a href="https://findyourground.online/#/login"><b>Login</b></a>',
					html:
					  ' or <a href="https://findyourground.online/#/signup"><b>Create an account</b></a>',
					showCloseButton: true,
					confirmButtonText:
					  '<i class="fa fa-thumbs-up"></i> Close',
				})

            } else if (response.data == "authentified"){
				Swal.fire({
					title: '<strong>You got it.</strong>',
					html:
					  '<strong>Property contact details:</strong><br><b>Phone number:</b> ' + $scope.property.propertyphone +
					  '<br><b>Email address:</b> ' + $scope.property.propertyemail +
					  '<br><b>Website:</b> <a target="_blank" href=http://'+ $scope.property.propertywebsite +'>'+$scope.property.propertywebsite+'</a>',
					showCloseButton: true,
					confirmButtonText:
					  '<i class="fa fa-thumbs-up"></i> Close'
				})
			}
        })
	}
});