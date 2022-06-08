'use strict';
     
ewtg.controller('profileCtrl', function($scope, profileService, loginService){
 
    $scope.updateProfile = function(profile){
        profileService.profile(profile, $scope)
    }


    //fetch login user
    var userrequest = loginService.fetchuser();
    userrequest.then(function(response){
        $scope.user = response.data[0];
    });

    var profilerequest = profileService.fetchprofile();
    profilerequest.then(function(response){
        $scope.profile = response.data[0];
    });

});