'use strict';

/* Services */

var AppyServices = angular.module('AppyServices', ['ngResource']);

AppyServices.factory('Job', ['$resource',
  function($resource){
    return $resource('jobs/:phoneId.json', {}, {
      query: {method:'GET', params:{phoneId:'jobs'}, isArray:true}
    });
  }]);

// AppyServices.factory('States', function($http) { 

//     var obj = {content:null};

//     $http.get('jobs/states.json').success(function(data) {
//         // you can do some processing here
//         obj.content = data;
//     });    

//     return obj;    
// });

AppyServices.factory('States', function($http) { 
    return $http.get('jobs/states.json'); //any backend route
});