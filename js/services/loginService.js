'use strict';
     
ewtg.factory('loginService', function($http, $location, sessionService){
    return{
        login: function(user, $scope){
            var validate = $http.post('backend/login.php', user);
            validate.then(function(response){
                var uid = response.data.user;
                if(uid){
                    sessionService.set('user',uid);
                    $location.path('/');
                }
 
                else{
                    $scope.successLogin = false;
                    $scope.errorLogin = true;
                    $scope.errorMsg = response.data.message;
                }
            });
        },
        logout: function(){
            sessionService.destroy('user');
            $location.path('/logout');
        },
        islogged: function(){
            var checkSession = $http.post('backend/loginSession.php');
            return checkSession;
        },
        fetchuser: function(){
            var user = $http.get('backend/fetch.php');
            return user;
        }
    }
});