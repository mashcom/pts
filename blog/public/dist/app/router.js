/**
 * Routing of the application is all handled here
 */
angular.module("AppRouter", ['ngRoute', 'Planner']);

angular.module("AppRouter").config(function ($routeProvider, $locationProvider) {

    $routeProvider.when('/', {
        controller: "PlanController",
        templateUrl: "partials/index.html"
    }).when('/home', {
        controller: "PlanController",
        templateUrl: "partials/index.html"
    }).when('/create', {
        controller: "PlanController",
        templateUrl: "partials/create.html"
    }).when('/plan', {
        controller: "PlanController",
        templateUrl: "partials/show.html"
    }).when('/plans', {
        controller: "PlanController",
        templateUrl: "partials/plans.html"
    }).when('/calendar', {
        controller: "PlanController",
        templateUrl: "partials/calendar.html"
    }).when('/curriculum', {
        controller: "PlanController",
        templateUrl: "partials/curriculum.html"
    }).when('/trash', {
        controller: "TrashController",
        templateUrl: "partials/trash.html"
    }).when('/404', {
        controller: "PlanController",
        templateUrl: "partials/404.html"
    }).when('/media', {
        controller: "MediaController",
        templateUrl: "partials/media.html"
    }).when('/shares', {
        controller: "ShareController",
        templateUrl: "partials/shares.html"
    }).when('/login', {
        controller: "AuthController",
        templateUrl: "partials/login.html"
    }).otherwise({
        redirectTo: '/404'
    });

});
