'use strict';

/* Services */

var AppyServices = angular.module('AppyServices', ['ngResource']);

AppyServices.factory('Job', ['$resource',
  function($resource){
    return $resource('jobs/:phoneId.json', {}, {
      query: {method:'GET', params:{phoneId:'jobs'}, isArray:true}
    });
  }]);
