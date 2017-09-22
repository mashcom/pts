angular.module('Planner', ['AppRouter', 'angular-growl', 'chieffancypants.loadingBar'])

        .controller('MasterPlanController', function ($scope, $http, $window, API_BASE, $location, cfpLoadingBar, growl) {


            $scope.getMasterPlans = function () {
                $http.get('http://localhost/aculyse/app/planner/api/get_masters.php?action=get').then(function successCallback(response) {
                    $scope.master_plans = response.data;
                    console.log(response.data);


                }, function errorCallback(response) {
                    return {"status": "error", "message": "Could not proccess request."};
                });
            };


            var transform = function (data) {
                return $.param(data);
            };


            $scope.createMaster = function () {
                $http({
                    method: "POST",
                    url: API_BASE + 'api/master_create.php',
                    data: {subject: $scope.subject_create, level: $scope.level_create},
                    transformRequest: transform
                })
                        .then(function successCallback(response) {
                            console.log(response.data);
                            closeModal("#InitMasterPlan");
                            growl.success('<b>Master Plan: created successfully.', {title: 'Success!'});

                            $scope.getMasterPlans();

                        }, function errorCallback(response) {

                        });
            }

            $scope.getClasses = function () {
                $scope.refreshing = true;
                $http.post(API_BASE + 'api/get_subjects').then(function successCallback(response) {

                    $scope.teacher_subjects = response.data;
                }, function errorCallback(response) {

                });
                $scope.refreshing = false;
            };
            $scope.getClasses();

        });
