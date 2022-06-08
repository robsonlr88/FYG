'use strict';
     
ewtg.factory('profileService', function($http, sessionService){
    return{
        profile: function(profile, $scope){
            var validate = $http.post('backend/profile.php', profile);
            validate.then(function(response){
                //console.log(response);
                var uid = response.data.user;
                if(uid){
                    sessionService.set('user',uid);
                    sweetAlert("All set","Your information was updated successfully.","success");
                }
 
                else{
                    $scope.successLogin = false;
                    $scope.errorLogin = true;
                    $scope.errorMsg = response.data.message;
                }
            });
        },
        fetchprofile: function(){
            var profile = $http.get('backend/profileGet.php');
            return profile;
        }
    }
});