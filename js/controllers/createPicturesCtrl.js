angular.module("ewtg").controller("propertyPicturesCtrl", function($scope, $http, $routeParams, createAPI, $location){

	function updateProgressBar(progressBar, value) {
		value = Math.round(value);
		progressBar.querySelector(".progress__fill").style.width = `${value}%`;
		progressBar.querySelector(".progress__text").textContent = `${value}%`;
	}
	const myProgressBar = document.querySelector(".progress");
	updateProgressBar(myProgressBar, 80);

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
		  },  
		  data : $scope.form,
		  headers: {
				 'Content-Type': undefined
		  }
	   }).then(function(response){
			if (response.data == 0){
				
				$location.path('/review/' + property.propertyid);
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

	$scope.getIdPictures = function () {
		createAPI.getIdPictures($routeParams.id)
		.then(function(response){
            if (response.data.error == false) {
                $scope.withData = response.data;
            }
			var foundit = response.data;
            if(foundit){
				$scope.property=response.data;
			}
			else{
				$location.path('/');
            }		
		});
	}

});