angular.module("Planbook.Feedback", ['angular-growl', 'ngAnimate', 'chieffancypants.loadingBar'])

        .controller('FeedbackController', function ($scope, $http, $location, growl, cfpLoadingBar) {

            $scope.report_url = $location.url();

            $scope.sendFeedback = function () {
                $scope.report_url = $location.absUrl();
                $http.post("../executers/feedback.php", "description=" + $scope.report_desc + "&url=" + $scope.report_url).then(function successCallback(response) {
                    if (response.data == "success") {
                        growl.success("Thank you for your valued feedback", {title: "Thank you"})
                        closeModal("#feedbackDialogModal")
                    }
                    else {
                        growl.warning("Failed to send the feedback, please try again", {title: "Failed!"})
                    }
                }, function errorCallback(response) {
                    growl.error("Server could not be reached to proccess you request", {title: "Ooops!"})
                });
            }
        })
