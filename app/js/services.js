'use strict';

/* Services */

var AppyServices = angular.module('AppyServices', ['ngResource']);

AppyServices.factory('Joblist', ['$resource',
  function($resource){
    return $resource('data/:companyid.json', {}, {
      query: {method:'GET', params:{companyid:'jobs'}, isArray:true}
    });
  }]);

AppyServices.factory('Company', ['$resource',
  function($resource){
 	return $resource('data/:companyid.json', {
      companyid : '@companyid',
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
    return $http.get('data/states.json'); //any backend route
});

AppyServices.factory('Students', function($http) { 
    return $http.get('data/students.json'); //any backend route
});

// AppyServices.factory('Companies', function($http) { 
//     return $http.get('data/companies/:companyid.json'); //any backend route
// })
