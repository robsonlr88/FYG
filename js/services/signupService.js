'use strict';
     
ewtg.factory('signupService', function($http, sessionService, $location){

    var _emailVerified = function (id){
        return $http.get("backend/verify-email.php?" + id);
    };

    return{
        signup: function(user, $scope){
            var validate = $http.post('src/signup/signup.php', user);
            validate.then(function(response){
                var uid = response.data.user;
                if(uid){
                    sessionService.set('user',uid);
                    sweetAlert("User registred successfully","Please check your Email box or Spam.","success");
                    $location.path('/signupConfirmEmail');   
                }
 
                else{
                    $scope.successLogin = false;
                    $scope.errorSignup = true;
                    $scope.errorMsg = response.data.message;
                    
                    sweetAlert("",$scope.errorMsg,"error");
                }
            });
        },

        emailVerified: _emailVerified

    }




});