'use strict';

/* Controllers */

var AppyControllers = angular.module('AppyControllers', []);

AppyControllers.controller('JobListCtrl', ['$scope', 'Job',
  function($scope, Job) {
    $scope.jobs = Job.query();
    $scope.charLimit=150;
    $scope.order = 'company';

  }]);

AppyControllers.controller('JobDetailCtrl', ['$scope', '$routeParams', 'Job',
  function($scope, $routeParams, Job) {
      $scope.job = Job.get({phoneId: $routeParams.phoneId}, function(job) {
      // $scope.mainImageUrl = phone.images[0];
    });

    $scope.setImage = function(imageUrl) {
      $scope.mainImageUrl = imageUrl;
    }
  }]);

//Home Controller
AppyControllers.controller('HomeCtrl', ['$scope', 'Job','$carousel', function($scope,Job, $carousel) {

	$scope.interval = 6000;
  	var slides = $scope.slides = [];
  	$scope.addSlide = function() {
   		var newWidth = slides.length;

    		for(var i=0;i<$carousel.length;i++) 
   			 slides.push($carousel[i]);
  	};

  	$scope.addSlide();

	//fake carousel data, will be ajax call later
}]).factory("$carousel",function() {

	return [
		{ 
			image: 'img/0.jpg',
		      title:"The New Campus Ambassador Website",
		      text: "UNC's own 3 students have announced an ambassador website."
		}, 
		{ 
			image: 'img/1.jpg',
		      title:"Google Ambassadors Landing",
		      text: "Google announces brand new opening for campus ambassadors."
		}, 	
		{ 
			image: 'img/2.jpg',
		      title:"Microsoft Ambassadors Landing",
		      text: "Redmond announces the expansion of its campus ambassadors network."
		}, 	
		{ 
			image: 'img/3.jpg',
		      title:"Facebook Webassadors",
		      text: "The social media outsources its campus networking to actual people."
		}, 	
	];

});



AppyControllers.controller('RegistrationCtrl', ['$scope', 'Job',
   function($scope) {

  }]);

AppyControllers.controller('AboutCtrl', ['$scope', 'Job',
   function($scope) {

  }]);

AppyControllers.controller('LoginCtrl', ['$scope', 'Job',
   function($scope) {

  }]);


AppyControllers.controller('ProfileCtrl', ['$scope', 'Job',
   function($scope) {

  }]);


AppyControllers.controller('StudentListCtrl', ['$scope', 'Job',
   function($scope) {

  }]);


AppyControllers.controller('HeaderController', ['$scope', '$location',
   function($scope, $location) {
     $scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };

 }]);
