angular.module('Planbook.Panel', ['Planbook.Planner', 'app'])

        .controller('PanelController', function ($scope, $http, API_BASE) {
            $scope.show_panel = false;

            $scope.initPanel = function () {
                $http.get(API_BASE + 'api/get_masters.php?action=get&tree=true').then(function successCallback(response) {
                    $scope.panel_tree = response.data;


                }, function errorCallback(response) {
                    return {"status": "error", "message": "Could not proccess request."};
                });
            }

            $scope.updatePanel = function () {
                $scope.initPanel();
            }

            $scope.showPanel = function () {
                $scope.show_panel = true;
            }

            $scope.hidePanel = function () {
                $scope.show_panel = false;
            }

        })
