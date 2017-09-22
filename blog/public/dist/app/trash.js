angular.module('Planbook.Trash', ['app', 'AppRouter', 'ngSanitize', 'planService', 'angular-growl', 'ngAnimate', 'chieffancypants.loadingBar'])

        //Trash controller
        .controller('TrashController', function ($scope, $http, $location, growl, cfpLoadingBar, API_BASE) {

            $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";


            $scope.getTrashedItems = function () {
                $http.get(API_BASE + "api/trash/get_trashed").then(function successCallback(response) {
                    $scope.trashed_items = response.data;
                    console.log(response.data);
                }, function errorCallback(response) {
                    growl.error("The server could not be reached, to complete your request. Is you internet connection working", {title: "Oops!"})
                })
            }

            $scope.permanentlyDeleteDialog = function (id) {
                $scope.unit_id_delete = id;
                openModal("#trashModal")
            }

            $scope.emptyTrash = function (action) {
                $scope.recycle(null, action, "yes");
            }


            $scope.recycle = function (id, action, everything) {

                var api_url, success_msg, failed_msg;
                if (action == "restore") {
                    api_url = API_BASE + "api/trash/restore";
                    success_msg = "Items Successfully restored";
                    failed_msg = "Restoration failed, please try again";

                }
                else if (action == "permanent") {
                    closeModal("#trashModal")
                    api_url = API_BASE + "api/trash/trash_permanently";
                    success_msg = "Items permanently deleted";
                    failed_msg = "Deleting failed, please try again";
                }
                else {
                    return;
                }
                alert("id=" + id + "&everything=" + everything)
                return
                $http.post(api_url, "id=" + id + "&everything=" + everything).then(function successCallback(response) {
                    console.log(response.data)
                    if (response.data == "success") {
                        growl.success(success_msg, {title: "Success!"});
                        $scope.getTrashedItems();
                    }
                    else {
                        growl.warning(failed_msg, {title: "Oops!"})

                    }
                }, function errorCallback(response) {
                    growl.error("The server could not be reached, to complete your request. Is you internet connection working", {title: "Oops!"})
                })
            }

        })
