angular.module('Planbook.Calendar', ['AppRouter','app'])
        .controller("CalendarController", ['$scope', '$http','API_BASE',function ($scope, $http,API_BASE) {
                //init date time picker
                //initTimePicker();

                $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

                var transform = function (data) {
                    return $.param(data)
                }

                $scope.events = {};

                $scope.getEvents = function () {
                    //alert($scope.end_time);
                    return;

                    $http({
                        method: 'POST',
                        url: API_BASE+'api/calendar.php'
                    }).then(function successCallback(response) {
                        $scope.events = response.data;
                    }, function errorCallback(response) {

                    });
                }

                $scope.addLessonToCalendar = function(){
                    var lesson_date = $scope.lesson_date;
                    var start_time = $scope.lesson_start_time;
                    var end_time = $scope.end_time;

                    console.log($scope)
                    //var starts = lesson_date.toString()+" "+start_time.toString();
                    //alert(starts)

                    return;


                    $http({
                        method:"POST",
                        url:API_BASE+'api/calendar/add_lesson',
                        data:"starts="+ starts +"&ends_at"+ ends_at+ "&background=green"
                    }).then(function successCallback(response) {
                       


                    }, function errorCallback(response) {

                    });

                }
            }
        ]);
