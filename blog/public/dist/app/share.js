angular.module('Planbook.Share', ['AppRouter', 'ngSanitize', 'planService', 'angular-growl', 'ngAnimate', 'chieffancypants.loadingBar'])

        .controller('ShareController', function ($scope, $http, $location, growl, cfpLoadingBar, API_BASE) {
            $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

            var transform = function (data) {
                return $.param(data);
            };

            $scope.share_permission = {
                permission: "readonly",
                can_share: false,
                can_clone: true
            };

            $scope.searchUsers = function () {
                $http.post(API_BASE + 'api/search_user', "user=" + $scope.search_term).then(function successCallback(response) {
                    $scope.search_results = response.data;
                    console.log(response.data)
                }, function errorCallback(response) {
                    growl.error("Could not reach the server to trash the resource", {title: "Ooops!"});
                });
            }

            $scope.sharePlan = function (master_id, user_id) {
                $http.post(API_BASE + "api/share/share", "user=" + user_id + "&master_id=" + master_id).then(function successCallback(response) {
                    if (response.data == "success") {
                        growl.success("Master Plan shared successfully <br>Mode- Readonly", {title: "Success"});
                    }

                    if (response.data == "failed") {
                        growl.warning("Sharing failed, please try gain", {title: "Ooops!"});
                    }


                }, function errorCallback(response) {
                    growl.error("Could not reach the server to process your request", {title: "Ooops!"});
                });

            }

            $scope.getShared = function () {
                $http.get(API_BASE + "api/share/get_shared").then(function successCallback(response) {

                    $scope.shared_plans = response.data;
                    //  console.log(response.data);

                }, function errorCallback(response) {
                    growl.error("Could not reach the server to process your request", {title: "Ooops!"});
                });

            }
        })
