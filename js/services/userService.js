'use strict';
     
ewtg.factory('userService', function($http){
    return{
        userinfo: function(){
            var user = $http.get('backend/user.php');
            return user;
        }
    }
});