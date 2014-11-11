'use strict';

/* App Module */

var AppyApp= angular.module('AppyApp', [
  'ngRoute',
//  'AppyAnimations',
  'AppyControllers',
  'AppyFilters',
  'AppyServices',
  'ui.bootstrap'
  
]);

AppyApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/home',{
        templateUrl: 'partials/home.html',
        controller: 'HomeCtrl'
      }).

      when('/companies', {
        templateUrl: 'partials/phone-list.html',
        controller: 'JobListCtrl'
      }).

      when('/phones/:phoneId', {
        templateUrl: 'partials/phone-detail.html',
        controller: 'JobDetailCtrl'
      }).
  
      when('/profile',{
        templateUrl: 'partials/profile.html',
        controller: 'ProfileCtrl'
      }).

      when('/registration',{
        templateUrl: 'partials/registration.html',
        controller: 'RegistrationCtrl'
      }).

      when('/about',{
        templateUrl: 'partials/about.html',
        controller: 'AboutCtrl'
      }).
        when('/login',{
        templateUrl: 'partials/login.html',
        controller: 'LoginCtrl'
      }).

      otherwise({
        redirectTo: '/home'
      });
  }]);
