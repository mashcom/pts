angular.module('Planbook.Media', ['AppRouter', 'ngSanitize', 'planService', 'angular-growl', 'ngAnimate', 'chieffancypants.loadingBar'])

        .controller('MediaController', function ($scope, $http, $location, growl, cfpLoadingBar) {
            $scope.page = 0;

            $scope.getMedia = function () {
                $http.get('api/media/files.php').then(function successCallback(response) {
                    $scope.media_list = response.data;
                    $scope.page_count = $scope.media_list.length;
                    console.log($scope.media_list)
                }, function errorCallback(response) {

                })
            }

            $scope.nextPage = function () {
                if ($scope.page_count > $scope.page) {
                    $scope.page += 1;
                }
                else {
                    growl.warning("You are already at the last page", {title: 'Ooops'});
                }
            }

            $scope.previousPage = function () {
                if ($scope.page > 0) {
                    $scope.page -= 1;
                }
                else {
                    growl.warning("You are already at the first page", {title: 'Ooops'});
                }
            }

        })

