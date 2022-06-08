angular.module("ewtg").controller("myPropertiesCtrl", function($scope, $routeParams, myPropertiesAPI, $location, loginService){

	$scope.propertyResult = [];

	$scope.getProperties = function () {
		var blockUnloggedUsers = loginService.islogged();
        blockUnloggedUsers.then(function(response){
            if(response.data != "authentified"){
                sweetAlert("Please login or register","You need an account to have access to this section.","error");
                $location.path('/');
            }
        });
		myPropertiesAPI.getProperties($routeParams.id)
		.then(function(response){
			if (!response.data.error) {
				$scope.properties = response.data.properties;
                $scope.otherStatus = response.data.otherStatus;
                $scope.myProperty = response.data;
            }
            else if(response.data.error == true) {
                $scope.noProperties = response.data;
				$scope.noProperties.message = response.data.message;
            }
            
		})
	}

});