'use strict';

/* Services */

var AppyServices = angular.module('AppyServices', ['ngResource']);

AppyServices.factory('Phone', ['$resource',
  function($resource){
    return $resource('phones/:phoneId.json', {}, {
      query: {method:'GET', params:{phoneId:'phones'}, isArray:true}
    });
  }]);
