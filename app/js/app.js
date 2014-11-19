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
        templateUrl: 'partials/job-list.html',
        controller: 'JobListCtrl'
      }).

      when('/profile/:companyid', {
        templateUrl: 'partials/profile-real.html',
        controller: 'CompanyDetailCtrl'
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
