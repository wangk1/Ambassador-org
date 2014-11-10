'use strict';

/* Controllers */

var AppyControllers = angular.module('AppyControllers', []);

AppyControllers.controller('PhoneListCtrl', ['$scope', 'Phone',
  function($scope, Phone) {
    $scope.phones = Phone.query();
    $scope.orderProp = 'age';
  }]);

AppyControllers.controller('PhoneDetailCtrl', ['$scope', '$routeParams', 'Phone',
  function($scope, $routeParams, Phone) {
    $scope.phone = Phone.get({phoneId: $routeParams.phoneId}, function(phone) {
      $scope.mainImageUrl = phone.images[0];
    });

    $scope.setImage = function(imageUrl) {
      $scope.mainImageUrl = imageUrl;
    }
  }]);

AppyControllers.controller('HomeCtrl', ['$scope', 'Phone',
   function($scope) {

  }]);

AppyControllers.controller('HeaderController', ['$scope', '$location',
   function($scope, $location) {
  
     $scope.isActive = function (viewLocation) { 
        return viewLocation === $location.path();
    };

 }]);