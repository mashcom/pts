angular.module('planService',[]).service('plannerService',function($http){

    this.requestHandler = function(requestMethod,requestUrl,requestParams){
      $http({
        method: requestMethod,
        url: requestUrl,
        data: requestMethod
      }).then(function successCallback(response) {
          return response.data;
      },
      function errorCallback(response) {
        return response.data
      });
    },
    this.getAll = function(){

      
      $http({
        method: 'POST',
        url: 'api/get_plan'
      }).then(function successCallback(response) {
          return response.data;
      },
      function errorCallback(response) {
        return response.data
      });
    }

});
