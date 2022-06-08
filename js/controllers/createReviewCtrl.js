angular.module("ewtg").controller("propertyReviewCtrl", function($scope, $routeParams, searchAPI, createAPI, editPropertyAPI, $location, userService, loginService){


	$scope.getReviewProperty = function () {

		var blockUnloggedUsers = loginService.islogged();
        blockUnloggedUsers.then(function(response){
            if(response.data != "authentified"){
                sweetAlert("Please login or register","You need an account to have access to this section.","error");
                $location.path('/');
            }
        });

		editPropertyAPI.getProperty($routeParams.id)
		.then(function(response){
		//sweetAlert("Final review","On this page you can review your property information and make changes before being published.");
		Swal.fire({
			title: "Final review",
			text: "On this page you can review your property information and make changes before being published.",
			confirmButtonText: 'OK',
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire({
					title: "Do not forget",
					text: "Click 'Submit Property' when you are done.",
					confirmButtonText: 'OK',
				})
			}
		})
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
					
	});	

	}


	
    var userrequest = userService.userinfo();
    userrequest.then(function(response){
        $scope.user=response.data.user[0];
    });

	$scope.reviewProperty = function (property) {
		createAPI.reviewProperty(property)
		.then(function(response){
			if(response.data.error == false){
				Swal.fire("All set, you've submitted your property.","Allow us up to 2 days to analise your submission and publish on our platform.","success")
				.then((result) => {
				if (result.isConfirmed) {
					Swal.fire({
						title: "In this page you can see how your property will look like",
						text: "You can still submit changes at 'Menu' -> 'Edit Properties'.",
						confirmButtonText: 'OK',
					})
				}
				searchAPI.propertyView($routeParams.id);
				$location.path('/property/' + $routeParams.id);
				})
			}			
		})
		}



});