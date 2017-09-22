
angular.module('Planbook.Planner', ['app', 'AppRouter', 'ngSanitize', 'planService', 'angular-growl', 'ngAnimate', 'chieffancypants.loadingBar'])

        .controller("PlanController", function ($scope, $http, $location, API_BASE, $sce, growl, plannerService, cfpLoadingBar) {


            $scope.csfp_token = $("#universal-token").data('universal-token');

            init_ui();

            $scope.plan_id = 0;
            $scope.submitting = false;
            $scope.refreshing = false;

            //wizard
            $scope.wizard_progress = 1;
            $scope.wizard_heading = "Create Lesson Plan";

            $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";

            //show a specific resource
            $scope.show = function () {
                $scope.refreshing = true;
                $scope.get_classes();

                var subject = $location.search().subject;

                $http({
                    method: 'POST',
                    url: API_BASE + 'api/get_plan'})
                        .then(function successCallback(response) {
                            $scope.plans_list = response.data;

                            $(".textarea").wysihtml5();
                        }, function errorCallback(response) {
                        });
                $scope.refreshing = false;
            };

            $scope.active_plans = {subject: "", level: ""}
            $scope.new_unit_title = '';

            //get plans and units in a master plan
            $scope.getLevelPlans = function () {

                $scope.master_plan_id = $location.search().mid;
                $scope.jump_to_unit = $location.search().unit;

                $http.post(API_BASE + 'api/get_level_plans', "mid=" + $scope.master_plan_id + "&_token=" + $scope.csfp_token
                        ).then(function successCallback(response) {

                    console.log(response.data);

                    if (response.data.status == "access_denied") {
                        $scope.is_denied = true;
                        return;
                    }

                    if ($location.hash() == "new_clone") {
                        openModal("#cloneModal");

                    }
                    $scope.is_shared = response.data.is_shared;
                    $scope.active_master_plan = response.data.id;
                    $scope.units = response.data.units;
                    $scope.lesson_count = response.data.lessons.length;
                    $scope.unit_count = response.data.units.length;

                    $scope.active_subject = response.data.subject.title;
                    $scope.active_level = response.data.level;


                }, function errorCallback(response) {
                });
            };

            //get info about a subject
            $scope.getSubjectName = function () {
                $http.get(API_BASE + 'api/subject?id=' + $scope.active_subject)
                        .then(function successCallback(response) {

                            $scope.active_subject_info = response.data;

                        }, function errorCallback(response) {

                        })
            };

            //create a new unit for a master plan
            $scope.newUnit = function () {

                $http({
                    method: 'POST',
                    url: API_BASE + 'api/create_unit',
                    data: "title=" + $scope.new_unit_title + "&mid=" + $scope.master_plan_id + "&subject=" + $scope.active_subject + "&level=FORM 2"
                })
                        .then(function successCallback(response) {
                            console.log(response.data);
                            if (response.data == "success") {
                                closeModal("#InitUnit");
                                growl.success('<b>UNIT: ' + $scope.new_unit_title + ' </b><br/>Created successfully.', {title: 'Success!'});
                                $scope.getLevelPlans();
                            }

                        }, function errorCallback(response) {
                        });
            };

            /**
             * Update the title of a unit in a master plan
             */
            $scope.updateUnitTitle = function (unit_id, ui_index) {

                var new_title = $("#unit-" + ui_index + " .unit-title").val();

                $http({
                    method: 'POST',
                    url: API_BASE + 'api/update_unit_title',
                    data: 'id=' + unit_id + "&title=" + new_title
                }).then(function successCallback(response) {
                    console.log(response.data)
                    if (response.data == "success") {
                        $scope.units[ui_index]['title'] = new_title;
                        $scope.edit_title = false;
                        $("#unit-" + ui_index + " .update_title").hide();
                        growl.success('Unit title updated', {title: 'Success'})
                    }
                    else {
                        growl.warning('Unit title failed to update', {title: 'No update'})
                    }

                }, function errorCallback(response) {
                    growl.error("Could not reach the server to trash the resource", {title: "Ooops!"});

                })
            }


            $scope.startEditing = function () {
                closeModal("#editDialog");

                $location.url("/plan?fresh=true&id=" + $scope.new_record.id);

            }


            /**
             *Send a unit or master plan to trash bin
             */
            $scope.trashUnit = function (unit_id, is_master) {
                $scope.is_master = is_master;
                $scope.unit_to_trash = unit_id;
                $scope.item = "UNIT";
                $scope.sub_items = "LESSONS";
                if (is_master) {
                    $scope.item = "MASTER PLAN";
                    $scope.sub_items = "UNITS and LESSONS";
                    $scope.master_to_trash = unit_id;
                }
                if(is_master ="is_single"){
                    $scope.is_single = true;
                }
                openModal("#trashModal");
            }


            /**
             *When user has confirmed that he intents to trash a resource, then run this function
             */
            $scope.trashingAccepted = function (unit_id) {

                $http({
                    method:"POST",
                    url:API_BASE + "api/trash/delete_unit",
                    data:"id=" + unit_id + "&is_master=" + $scope.is_master+"&is_single="+$scope.is_single
                }).then(function successCallback(response) {
                    console.log(response.data);

                    if (response.data.status == "access_denied") {
                        growl.error("You do not have the permission to modify this resource because it was shared with you by the original author in readonly mode. If want full permission, clone the Master Plan first for yourself" +
                                "<br/><br/><button class='btn btn-md btn-action' ng-click='cloneMaster(master_plan_id)'>Clone Master Plan Now!</button>", {title: "Request Denied!"});
                        return;
                    }
                    if (response.data == "success") {
                        growl.success("Resource trashed successfully", {title: "Trashed"});
                        if ($scope.is_master==true || $scope.is_single==true) {
                            $location.url("/")
                            return;
                        }
                        $scope.getLevelPlans();
                    }
                    else {
                        growl.warning("Trashing could no complete, please try again", {title: "Failed"});
                    }

                }, function errorCallback(response) {
                    growl.error("Could not reach the server to trash the resource", {title: "Ooops!"});
                });

                closeModal("#trashModal");
            }


            //clone shared plan
            $scope.cloneMaster = function (id) {
                closeModal("#cloneDialogModal")
                $http.post(API_BASE + "api/clone/cloner", "id=" + id).then(function successCallback(response) {
                    console.log(response.data);
                    if (response.data.status == "success") {
                        growl.success("Master Plan cloned successfully", {title: "Cloned"});
                        $location.url("/curriculum?mid=" + response.data.id + "#new_clone");
                        return
                    }
                    growl.warning("failed to clone. No changes have been saved", {title: "Clone Failed!"})
                }, function errorCallback(response) {
                    growl.error("Could not reach the server to clone the resource", {title: "Ooops!"});
                })
            }

            //create a new resource
            $scope.getEvents = function () {
                $http({
                    method: 'POST',
                    url: API_BASE + 'api/calendar.php'
                }).then(function successCallback(response) {
                    $scope.events = response.data;
                    loadCalendar($scope.events);

                }, function errorCallback(response) {

                });
            }

            $scope.initCalendar = function () {
                loadCalendar()
            }

            /**
             *View a single plan in preview mode without editor
             */
            $scope.previewMode = function () {
                $scope.edit_mode = false;
                $scope.toggle_preview_mode = true;
                $scope.getSinglePlan();
            }

            /**
             *Activate the editor
             */
            $scope.editMode = function () {
                $scope.edit_mode = true;
                $scope.toggle_preview_mode = false;

            }
            $scope.editMode();

            //show a specific resource
            $scope.getSinglePlan = function () {
                $scope.refreshing = true;

                plan_id = $location.search().id;
                $scope.active_single_plan = plan_id;

                $scope.active_plan = plan_id;
                if ($scope.edit_mode == false) {
                    $location.url("/plan?id=" + plan_id);
                }
                var fresh = $location.search().fresh;
                if (fresh == "true") {
                    $scope.editMode();
                }

                //init date time picker
                initTimePicker();
                $http({
                    method: 'POST',
                    url: API_BASE + 'api/show_plan',
                    data: {'plan_id': plan_id},
                    transformRequest: transform
                }).then(function successCallback(response) {

                    if (response.data.status == "access_denied") {
                        $scope.is_denied = true;
                        growl.error("You do not have the permission to view this resource", {title: "Request Denied!"});
                        return;
                    }
                    $scope.plan = response.data;
                    //console.log(response.data);
                    $("#sandbox").empty();
                    $("#sandbox").append($scope.plan.content);
                    $scope.text_editor = $scope.plan.content;


                    if ($scope.toggle_preview_mode != true) {
                        $(".textarea").wysihtml5();
                        $(".wysihtml5-toolbar").append('<li><a class="btn  btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="blockquote" data-wysihtml5-display-format-name="false"><span class="glyphicon glyphicon-th"></span> Table</a></li>');
                        $(".wysihtml5-toolbar").append('<li><a class="btn  btn-default" data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="blockquote" data-wysihtml5-display-format-name="false"><span class="glyphicon glyphicon-picture"></span> Insert Media</a></li>');

                    }

                }, function errorCallback(response) {

                });
                $scope.refreshing = false;
            };

            //get subjects
            $scope.get_classes = function () {
                $scope.refreshing = true;
                $http({
                    method: 'POST',
                    url: API_BASE + 'api/get_subjects'
                }).then(function successCallback(response) {
                    $scope.teacher_subjects = response.data;

                }, function errorCallback(response) {

                });
                $scope.refreshing = false;
            };

            var transform = function (data) {
                return $.param(data)
            }

            //create a new resource
            $scope.create = function () {
                $scope.parameters = {
                    "topic": $scope.topic,
                    "subject": $scope.active_plans.subject,
                    "unit": $scope.unit
                };
                console.log($scope.parameters);

                $scope.submitting = true;

                $http({
                    method: 'POST',
                    url: API_BASE + 'api/create',
                    data: $scope.parameters,
                    transformRequest: transform
                }).then(function successCallback(response) {
                    $scope.new_record = response.data;
                    $scope.plan_id = response.data.id;
                    $scope.wizard_progress += 1;
                    $scope.wizard_heading = $scope.topic;
                    closeModal("#InitPlan");
                    growl.success('<b>TOPIC: ' + $scope.topic + ' </b><br/>Created successfully.', {title: 'Success!'});
                    openModal("#editDialog");
                    $scope.getLevelPlans();
                    //location.href = "#/plan?fresh&id=" + $scope.plan_id;

                }, function errorCallback(response) {

                });
                $scope.submitting = false;
            }

            //UPDATE A RESOURCE COLUMN
            $scope.update = function () {
                //$("#text-area-og").show();
                var content = $("#text-area-og").val();

                $scope.text_editor = content;
                $scope.parameters = {
                    "id": $scope.active_plan,
                    "content": $scope.text_editor,
                    "topic": $scope.plan.topic
                };



                $http({
                    method: 'POST',
                    url: API_BASE + 'api/update_plan',
                    data: $scope.parameters,
                    transformRequest: transform
                }).then(function successCallback(response) {
                    console.log(response.data)
                    $scope.wizard_progress += 1;
                    $scope.wizard_heading = $scope.topic;
                    if (response.data.status == "success") {
                        growl.success("Update successful", {title: "Success!"});
                    }
                    else {
                        growl.warning("Update failed to complete. Please try again", {title: "Oops!"});
                    }

                }, function errorCallback(response) {

                });
            }



            $scope.getMasterPlans = function () {
                $http.get(API_BASE + 'api/get_masters.php?action=get').then(function successCallback(response) {
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

                $http.post(API_BASE + 'api/master_create.php',
                        "subject=" + $scope.subject_create + "&level=" + $scope.level_create
                        )
                        .then(function successCallback(response) {
                            closeModal("#InitMasterPlan");
                            growl.success('<b>Master Plan: created successfully.', {title: 'Success!'});

                            $scope.getMasterPlans();

                        }, function errorCallback(response) {
                            growl.error('Unexpected error just happened, if this persists your can report it', {title: 'Error!'});

                        });
            }

            $scope.get_classes();
            $scope.defaults_view = "list";
            $scope.tableView = function () {
                $scope.defaults_view = "table";
            }

            $scope.listView = function () {
                $scope.defaults_view = "list";
            }


        })
