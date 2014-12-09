'use strict';

/* Controllers */

var AppyControllers = angular.module('AppyControllers', []);

AppyControllers.controller('JobListCtrl', ['$scope', 'Joblist', 'States',
  function($scope, Joblist) {
    $scope.jobs = Joblist.query();
    $scope.charLimit=150;
    $scope.order = 'application_date';
  }]);

AppyControllers.controller('CompanyDetailCtrl', ['$scope', '$routeParams', 'Company',
  function($scope, $routeParams, Company) {
      
      $scope.company = Company.get({companyid: $routeParams.companyid}, function(data) {});

  }]);

//Home Controller
AppyControllers.controller('HomeCtrl', ['$scope','$carousel', function($scope, $carousel) {

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



AppyControllers.controller('RegistrationCtrl', ['$scope', '$http',
   function($scope, $http) {
    $scope.form={};
    $scope.form.type="student";
    $scope.account="not_created";

    $scope.signup = function() {
      $scope.message="";
      if ($scope.form.confirm_password!=$scope.form.password){
        $scope.message="Passwords did not match!"
      }
      // else if (($scope.form.type=="student") && (!($scope.form.password || $scope.form.email || $scope.form.first_name || $scope.form.last_name || $scope.form.major || $scope.form.year || $scope.form.school))){
      //       $scope.message="You missed input field(s)"
      // }
      // else if (($scope.form.type=="company") && !($scope.form.password || $scope.form.email || $scope.form.company || $scope.form.job_title || $scope.form.job_description || $scope.form.date || $scope.form.website  || $scope.form.schools)){
      //       $scope.message="You missed input field(s)";
      // }

      else{
        console.log($scope.form);
      }
      
    $http.post('api/rest.php',$scope.form).
       success(function(data, status, headers, config) {
        console.log(data);
        $scope.account="created"
        window.location = '#/home';
    }).
     error(function(data, status, headers, config) {
         console.log("not ok");
       // called asynchronously if an error occurs
       // or server returns response with an error status.
     });

}


  }]);

AppyControllers.controller('AboutCtrl', ['$scope',
   function($scope) {

  }]);

AppyControllers.controller('LoginCtrl', ['$scope',  '$http',
   function($scope,  $http) {

    $scope.login = function(){
      console.log($scope.form);

      $http.post('api/login.php',$scope.form).
       success(function(data, status, headers, config) {
       console.log(data);
      }).
      error(function(data, status, headers, config) {
        console.log("not ok");
     // called asynchronously if an error occurs
     // or server returns response with an error status.
     });


    }



  }]);


AppyControllers.controller('ProfileCtrl', ['$scope',
   function($scope) {

  }]);


AppyControllers.controller('StudentListCtrl', ['$scope', 'States', 'Students','$http',
  function($scope, States, Students, $http) {
    

    $http.get('api/rest.php/students/').
  success(function(data, status, headers, config) {
      console.log("this is the printed data");
      console.log(data);
      $scope.students=data;
  }).
  error(function(data, status, headers, config) {
    // called asynchronously if an error occurs
    // or server returns response with an error status.
  });


    States.success(function(data) { 
      $scope.states=data;
      $scope.statechoose=$scope.states[0];
    });

  //  Students.success(function(data) { 
   //   $scope.students=data;
   // });

    $scope.majors=["All", "Technical/Engineering", "Business"];
    $scope.majorchoose=$scope.majors[0];
  }]);


AppyControllers.controller('HeaderController', ['$scope', '$location',
   function($scope, $location) {
     $scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };

 }]);
