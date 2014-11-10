'use strict';

/* App Module */

var AppyApp= angular.module('AppyApp', [
  'ngRoute',
  'AppyAnimations',
  'AppyControllers',
  'AppyFilters',
  'AppyServices'
]);

AppyApp.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/home',{
        templateUrl: 'partials/home.html',
        controller: 'HomeCtrl'
      }).

      when('/companies', {
        templateUrl: 'partials/job-list.html',
        controller: 'JobListCtrl'
      }).

      when('/phones/:phoneId', {
        templateUrl: 'partials/job-detail.html',
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
        when('/student-list',{
        templateUrl: 'partials/student-list.html',
        controller: 'StudentListCtrl'
      }).

      otherwise({
        redirectTo: '/home'
      });
  }]);
