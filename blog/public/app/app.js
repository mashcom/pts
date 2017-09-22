angular.module('testingApp', ['angular-growl','timer'])
        .controller('MainCtrl', function ($scope, $http, growl) {

            $scope.base_url = "http://localhost/laravel/blog/public/";
            $scope.active_qn = 0;
            $scope.active_test = angular.element("#active_test").val();
            
            $scope.active_answer = false;
            $scope.completed = false;
            $scope.max_qns = angular.element("#max_qns").val();
            $scope.started = false;
            $scope.expiry_time = null;
            $scope.active_edit = null;
            $scope.edit_parsed_answer = null;
            $scope.is_edit_mode = false;
            $scope.edit_name = null;

            $scope.update_errors = [];

            $scope.chart_names = angular.element("#chart_names").val();
            $scope.chart_scores = angular.element("#chart-scores").val();


            $scope.correct_stat = angular.element("#correct-stat").val();
            $scope.incorrect_stat = angular.element("#incorrect-stat").val();

            $scope.timer_finished = false;
            $scope.time_in_seconds = 0;

            $scope.sync_modal_open = true;

            $scope.finished = function(){
                $scope.timer_finished = true;
            },
            $scope.startTest = function () {
                $scope.started = true;

                growl.info("Intialising test timer", {title: "Heads Up"})
                
                $http.post($scope.base_url + 'timer?test_id=' + $scope.active_test)
                        .then(
                                // resolved handler
                                        function (response) {
                                            $scope.time_in_seconds = response.data;
                                            console.log($scope.time_in_seconds)
                                            var el= angular.element(document.querySelector("#timer-div"));
                                            el.attr('countdown',$scope.time_in_seconds);
                                            //console.log(location)

                                            location.href = $scope.base_url+"test/"+$scope.active_test;
                                            $scope.expiry_time = response.data.expiry_time;
                                            growl.success("Timer started", {title: "Success"});
                                        }, function (response) {
                                    console.log(response.data);
                                });
                            },

            $scope.updateTest = function () {
                var edit_name = angular.element("#edit_name").val();
                var edit_description = angular.element("#edit_description").val();
                var edit_duration = angular.element("#edit_duration").val();
                var edit_token = angular.element("#edit_token").val();

                var data = "name="+edit_name+"&description="+edit_description+"&duration="+edit_duration+"&_token="+edit_token;
        
                $http.put($scope.base_url + 'test/' + $scope.active_test+"?"+data)
                        .then(
                                // resolved handler
                                        function (response) {
                                            if(response.data =="true"){
                                                growl.success("Update Successful", {title: "Success"});
                                                
                                            }else{
                                              growl.warning("Update response could not be handled", {title: "Unknown Error"});
                                              
                                            }
                                            location.reload();
                                        }, function (response) {
                                            console.log(response.data)
                                    growl.error("Server could not respond to then request. Make sure you have submitted all fields", {title: "Error"});
                                       
                                });
                            },

            $scope.updateProfile = function () {
                var update_id = angular.element("#update_id").val();
                var update_name = angular.element("#update_name").val();
                var update_email = angular.element("#update_email").val();
                var update_sex = angular.element("#update_sex").val();
                var update_dob = angular.element("#update_dob").val();
                var update_education = angular.element("#update_education").val();
                var update_employment_type = angular.element("#update_employment_type").val();
                var update_token = angular.element("#update_token").val();

                var data = "name="+update_name+"&email="+update_email+"&sex="+update_sex+"&_token="+update_token+"&dob="+update_dob+"&education="+update_education+"&employment_type="+update_employment_type;
               
        
                $http.put($scope.base_url + 'user/' + update_id+"?"+data)
                        .then(
                                // resolved handler
                                        function (response) {
                                            if(response.data =="true"){
                                                growl.success("Update Successful", {title: "Success"});
                                                
                                            }else{
                                              growl.warning("Update response could not be handled", {title: "Unknown Error"});
                                              
                                            }
                                            location.reload();
                                        }, function (response) {
                                            $scope.errors = response.data;
                                            console.log(response.data)
                                    growl.error("Server could not respond to then request. Make sure you have submitted all fields", {title: "Error"});
                                       
                                });
                            },

                    $scope.updateSelected = function (checked_answer) {
                        $scope.active_answer = checked_answer;
                    },
                            $scope.skip = function (question_db_id) {
                                $scope.active_answer = "skipped";
                                $scope.saveAnswer(question_db_id);
                                //	$scope.active_qn +=1;
                            },
                            $scope.previous = function () {
                                $scope.active_qn -= 1;
                            },
                            $scope.next = function () {
                                //alert($scope.max_qns)
                                $scope.active_qn += 1;
                                $scope.active_answer = false;
                                if ($scope.active_qn == $scope.max_qns) {
                                    $scope.completed = true;
                                }

                            },
                            $scope.submit = function () {
                                $scope.saveAnswer();
                                $scope.skip();
                           },
                            $scope.getQuestion = function (question_id) {
                                $scope.activateDialog(question_id);
                                $scope.is_edit_mode = true;
                                $http.get($scope.base_url + 'admin/test/' + $scope.active_qn + "/edit")
                                        .then(
                                                // resolved handler
                                                        function (response) {
                                                            console.log(response);
                                                            $scope.edit_parsed_answer = JSON.parse(response.data.answers);
                                                            $scope.active_edit = response.data;
                                                            return;
                                                        },
                                                        // rejected handler
                                                                function (response) {
                                                                    growl.warning("Server could not respond to the request.", {title: "Error"})
                                                                }
                                                        );
                                                    },
                                                    $scope.deleteQuestion = function () {
                                                        $http.post($scope.base_url + 'admin/delete_qn/' + $scope.active_qn)
                                                                .then(
                                                                        // resolved handler
                                                                                function (response) {
                                                                                    console.log(response);
                                                                                    if (response.data == "1") {
                                                                                        growl.success("Question successfully deleted", {title: "Success"})
                                                                                        location.reload();

                                                                                    } else {
                                                                                        growl.warning("Question could not be deleted", {title: "Ooops"})

                                                                                    }
                                                                                },
                                                                                // rejected handler
                                                                                        function (response) {
                                                                                            growl.warning("Server could not respond to the request.", {title: "Error"})
                                                                                        }
                                                                                );
                                                                            },
                                                                            $scope.activateDialog = function (question_id) {
                                                                                $scope.active_qn = question_id;
                                                                            },
                                                                            $scope.saveAnswer = function (question_db_id) {

                                                                                if ($scope.active_answer == false) {
                                                                                    $scope.skip(question_db_id);
                                                                                    growl.warning("Question has no answer it has been marked as skipped", {title: "Warning"})
                                                                                    return;
                                                                                }
                                                                                $http.post($scope.base_url + 'score?test_id=' + $scope.active_test + "&question_id=" + question_db_id + "&answer=" + $scope.active_answer)
                                                                                        .then(
                                                                                                // resolved handler
                                                                                                        function (response) {
                                                                                                            if (response.data == "true") {
                                                                                                                growl.success("Answer submitted successfully", {title: "Success"})
                                                                                                                $scope.next();
                                                                                                            }
                                                                                                            ;
                                                                                                        },
                                                                                                        // rejected handler
                                                                                                                function (response) {
                                                                                                                    // response object has the properties
                                                                                                                    // data, status, headers, config, statusText
                                                                                                                }
                                                                                                        );
                                                                                                    }
                                                                                        });
