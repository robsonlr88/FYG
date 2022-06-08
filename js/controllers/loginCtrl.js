'use strict';
     
ewtg.controller('loginCtrl', function($scope, loginService){
    $scope.errorLogin = false;
 
    
    $scope.login = function(user){
        loginService.login(user, $scope);
    }
 
    $scope.clearMsg = function(){
        $scope.errorLogin = false;
    }

    //fetch login user
    var userrequest = loginService.fetchuser();
    userrequest.then(function(response){
        $scope.user = response.data[0];
    });

    //logout
    $scope.logout = function(){
        loginService.logout();
    }
});