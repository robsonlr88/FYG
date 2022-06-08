angular.module("ewtg").controller("editPicturesCtrl", function($scope, $http, $routeParams, editPropertyAPI, $location, loginService){

	$scope.getEditProperty = function () {

		var blockUnloggedUsers = loginService.islogged();
        blockUnloggedUsers.then(function(response){
            if(response.data != "authentified"){
                sweetAlert("Please login or register","You need an account to have access to this section.","error");
                $location.path('/');
            }
        });

		editPropertyAPI.getProperty($routeParams.id)
		.then(function(response){
			sweetAlert("This page is being improved","In case you want to update your pictures, at this time you will be required to upload all of your 5 pictures again.","warning");
			$scope.property=response.data;				
		});	

	}


	$scope.getId = function () {
		editPicturesAPI.getId($routeParams.id)
		.then(function(response){
			$scope.propertyResult=response.data.property;
		});
	}

	$scope.getIdPictures = function () {
		editPicturesAPI.getIdPictures($routeParams.id)
		.then(function(response){
			$scope.propertyResult=response.data.property;
		});
	}

	$scope.form=[];
	$scope.files=[];
	$scope.property=[];
	$scope.insert=function(property){
		$scope.property.image0=$scope.files0[0];
		$scope.property.image1=$scope.files1[0];		
		$scope.property.image2=$scope.files2[0];		
		$scope.property.image3=$scope.files3[0];		
		$scope.property.image4=$scope.files4[0];		
		$http({
			method:'POST',
			url:"backend/createPicturesInsertUpdate.php",
			processData:false,
			transformRequest:function(data){
				var formData=new FormData();
				formData.append("propertyid", property.propertyid);
				formData.append("image0", $scope.property.image0);
				formData.append("image1", $scope.property.image1);
				formData.append("image2", $scope.property.image2);
				formData.append("image3", $scope.property.image3);
				formData.append("image4", $scope.property.image4);

			  return formData;
			  return property.propertyid;
		  },  
		  data : $scope.form,
		  headers: {
				 'Content-Type': undefined
		  }
	   }).then(function(response){
			if (response.data == 0){
				sweetAlert("All set! Your pictures were updated.","Now, you're being redirected to the editing page.","success");
				$location.path('/editProperty/' + property.propertyid);
			} else {
				sweetAlert("One of your files is too big","Maximum size accepted is 2MB","error");
			}
	   });
	   
	};
		
	$scope.uploadedFile0=function(element){
		$scope.currentFile0 = element.files[0];
		var reader = new FileReader();
		reader.onload = function(event) {
			var output0 = document.getElementById('output0');
			output0.src = URL.createObjectURL(element.files[0]);
			$scope.image_source = event.target.result
			$scope.$apply(function($scope) {
				$scope.files0 = element.files;
		  	});
		}
		reader.readAsDataURL(element.files[0]);
	}
	
	$scope.uploadedFile1=function(element){
		$scope.currentFile1 = element.files[0];
		var reader = new FileReader();
		reader.onload = function(event) {
			var output1 = document.getElementById('output1');
			output1.src = URL.createObjectURL(element.files[0]);
			$scope.image_source = event.target.result
			$scope.$apply(function($scope) {
				$scope.files1 = element.files;
		  	});
		}
		reader.readAsDataURL(element.files[0]);
	}


	$scope.uploadedFile2=function(element){
		$scope.currentFile2 = element.files[0];
		var reader = new FileReader();
		reader.onload = function(event) {
			var output2 = document.getElementById('output2');
			output2.src = URL.createObjectURL(element.files[0]);
		  	$scope.image_source = event.target.result
		  	$scope.$apply(function($scope) {
				$scope.files2 = element.files;
		  	});
		}
		reader.readAsDataURL(element.files[0]);
	}


	$scope.uploadedFile3=function(element){
		$scope.currentFile3 = element.files[0];
		var reader = new FileReader();
		reader.onload = function(event) {
			var output3 = document.getElementById('output3');
			output3.src = URL.createObjectURL(element.files[0]);
		  	$scope.image_source = event.target.result
		  	$scope.$apply(function($scope) {
				$scope.files3 = element.files;
		  	});
		}
		reader.readAsDataURL(element.files[0]);
	}

	$scope.uploadedFile4=function(element){
		$scope.currentFile4 = element.files[0];
		var reader = new FileReader();
		reader.onload = function(event) {
			var output4 = document.getElementById('output4');
			output4.src = URL.createObjectURL(element.files[0]);
		  	$scope.image_source = event.target.result
		  	$scope.$apply(function($scope) {
				$scope.files4 = element.files;
		  	});
		}
		reader.readAsDataURL(element.files[0]);
	}


});