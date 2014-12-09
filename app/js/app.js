'use strict';

/* App Module */

var AppyApp= angular.module('AppyApp', [
  'ngRoute',
//  'AppyAnimations',
  'AppyControllers',
 'AppyServices',
 'AppyFilters',
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

      when('/profile-connected/:companyid', {
        templateUrl: 'partials/profile-connected.html',
        controller: 'FakeCompanyDetailCtrl'
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
       when('/testimonials',{
        templateUrl: 'partials/testimonials.html',
      }).

      when('/connected-student-list',{
        templateUrl: 'partials/connect-student-list.html',
        controller: 'FakeStudentListCtrl'
      }).

      when('/connected-company-list',{
        templateUrl: 'partials/connect-company-list.html',
        controller: 'FakeCompanyListCtrl'
      }).

 when('/update-test',{
        templateUrl: 'partials/update-test.html',
        controller: 'UpdateTestCtrl'
      }).


      otherwise({
        redirectTo: '/home'
      });
  }]);
