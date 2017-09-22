angular.module('Planner',
        [
            'Planbook.Planner',
            'Planbook.Trash',
            'Planbook.Media',
            'Planbook.Panel',
            'Planbook.Share',
            'Planbook.Feedback',
            'Planbook.Calendar',
            'app',
            'AppRouter',
            'ngSanitize',
            'planService',
            'angular-growl',
            'ngAnimate',
            'chieffancypants.loadingBar'
        ])


        .value('APP_VERSION', 'v1.0')

        .value('API_BASE', "http://app.aculyse.com:8080/planner/")

//basic application init
        .controller('HeaderController', function ($scope, $http, API_BASE) {
            //get profile pic
            $http.get(API_BASE + "api/user/get_avatar?avatar").then(function successCallback(response) {
                $scope.user_avatar = response.data;
            }, function errorCallback(response) {

            });

            //get all user information
            $http.get(API_BASE + "api/user/get_avatar").then(function successCallback(response) {
                $scope.logged_user = response.data;
            }, function errorCallback(response) {

            });

            init_ui();
        })
