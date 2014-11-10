'use strict';

/* Controllers */

var AppyControllers = angular.module('AppyControllers', []);

AppyControllers.controller('JobListCtrl', ['$scope', 'Job',
  function($scope, Job) {
    $scope.jobs = Job.query();
    console.log($scope.jobs);
    $scope.orderProp = 'age';
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

AppyControllers.controller('HomeCtrl', ['$scope', 'Job',
   function($scope) {

  }]);

AppyControllers.controller('HeaderController', ['$scope', '$location',
   function($scope, $location) {
     $scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };

 }]);