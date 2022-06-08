var ewtg = angular.module('ewtg', ["ngMessages", "ngRoute",]);

ewtg.run(function($rootScope, $location, loginService){

    //prevent going back to login page if session is set
    var sessionStarted = ['/login'];
    $rootScope.$on('$routeChangeStart', function(){
        if(sessionStarted.indexOf($location.path()) !=-1){
            var cantgoback = loginService.islogged();
            cantgoback.then(function(response){
                if(response.data){
                    $location.path('/');
                }
            });
        }
    });

    //prevent going back to singup page
	var signupcompleted = ['/signup'];
	$rootScope.$on('$routeChangeStart', function(){
		if(signupcompleted.indexOf($location.path()) !=-1){
			var signupsuccess = loginService.islogged();
			signupsuccess.then(function(response){
				if(response.data){
					$location.path('/home');
				}
			});
		}
	});


    //prevent going to propetyInfo if not loggedin
    var isItLoggedin = ['/info'];
    $rootScope.$on('$routeChangeStart', function(){
        if(isItLoggedin.indexOf($location.path()) !=-1){
            var blockUnloggedUsers = loginService.islogged();
            blockUnloggedUsers.then(function(response){
                console.log(response.data);
                if(response.data == "authentified"){
                    $location.path('/info');
                } else {
                    sweetAlert("Please login or register","You need an account to have access to this section.","error");
                    $location.path('/');
                }
            });
        }
    });

//    var myProperties = ['/myProperties/:' + ':id'];
//    $rootScope.$on('$routeChangeStart', function(){
//        if(myProperties.indexOf($location.path()) !=-1){
//            var blockMyProperties = loginService.islogged();
//            blockMyProperties.then(function(response){
//                console.log(response);
//                if(response.data == "authentified"){
//                    $location.path('/myProperties');
//                } else {
//                    sweetAlert("Please login or register","You need an account to have access to this section.","error");
//                    $location.path('/');
//                }
//            });
//        }
//    });


    //prevent going to propetyInfo if not loggedin
    var blockSubmission = ['/editProperty/'];
    $rootScope.$on('$routeChangeStart', function(){
        if(blockSubmission.indexOf($location.path()) !=-1){
            var connected = loginService.islogged();
            connected.then(function(response){
                if(!response.data){
                    $location.path('/');
                }
            });
    
        }
    });


});