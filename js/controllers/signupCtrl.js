'use strict';
     
ewtg.controller('signupCtrl', function($scope, signupService, $routeParams){
    $scope.errorSignup = false;
 
    $scope.signup = function(user){
        signupService.signup(user, $scope);
    }
 
    $scope.clearMsg = function(){
        $scope.errorSignup = false;
    }

    signupService.emailVerified($routeParams.id)
        .then(function(response){
            if (response.data.error == false) {
                $scope.emailVerified = response.data.message;
            }
            else if(response.data.error == true) {
                $scope.emailNotVerified = response.data.error;
                $scope.signup.message = response.data.message;
            }
    });

});