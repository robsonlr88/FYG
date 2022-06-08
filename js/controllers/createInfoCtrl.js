angular.module("ewtg").controller("propertyInfoCtrl", function($scope, $routeParams, createAPI, $location, loginService){


	function updateProgressBar(progressBar, value) {
		value = Math.round(value);
		progressBar.querySelector(".progress__fill").style.width = `${value}%`;
		progressBar.querySelector(".progress__text").textContent = `${value}%`;
	}
	const myProgressBar = document.querySelector(".progress");
	updateProgressBar(myProgressBar, 0);

	$scope.propertyInfo = function (property) {
		var blockUnloggedUsers = loginService.islogged();
        blockUnloggedUsers.then(function(response){
            if(response.data != "authentified"){
                sweetAlert("Please login or register","You need an account to have access to this section.","error");
                $location.path('/');
            }
			createAPI.infoInsertUpdate(property)
			.then(function(response){
				if (response.data.error == false) {
					$scope.withData = response.data;
				}
				$location.path('/propertyInfo/' + $scope.withData.propertyid);
				sweetAlert("Saved!","Click NEXT to add what Resources your property has.","success");
			})
		});
	}

	$scope.getIdInfo = function () {

	var blockUnloggedUsers = loginService.islogged();
       	blockUnloggedUsers.then(function(response){
           	if(response.data != "authentified"){
				Swal.fire({
					title: 'Please <a href="https://findyourground.online/#/login"><b>Login</b></a>',
					html:
					  ' or <a href="https://findyourground.online/#/signup"><b>Create an account</b></a>',
					showCloseButton: true,
					confirmButtonText:
					  '<i class="fa fa-thumbs-up"></i> Close',
				})
               $location.path('/login');
           	} else if (response.data == "authentified" ){
				createAPI.getIdInfo($routeParams.id)
				.then(function(response){
					if (response.data.error == false) {
						$scope.withData = response.data;
					} else if (response.data.error == true){
						Swal.fire({
							title: "Let's start",
							text: "The information you are about to provide will be shared with potential clients who want to stay in your property. Therefore, do not provide your personal information at any time.",
							confirmButtonText: 'OK',
						}).then((result) => {
							if (result.isConfirmed) {
								Swal.fire({
									title: "Be mindful.",
									text: "Provide the most complete and accurate information possible in all the next 5 steps. With that, we increase the chances to match the expectations of your future guests with what they will actually find during their stay.",
									confirmButtonText: 'OK',
								})
							}
						})
					}
					var foundit = response.data;
					if(foundit){
						$scope.property=response.data;
					}
					else{
						$location.path('/');
					}
				})
			}
		});
	}

});