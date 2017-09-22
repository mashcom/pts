<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Psychometric Testing System | Alcore System</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/assets/angular-growl.min.css')}}">
        <link rel="stylesheet" href="{{asset('dist/js/vendor/cfploader/loading-bar.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
         <link rel="stylesheet" href="{{asset('plugins/pace/pace.min.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="hold-transition skin-purple sidebar-colapsed sidebar-collapse fixed" ng-app='testingApp' >
        <!-- Site wrapper -->
        <div class="wrapper" ng-controller='MainCtrl'>

            <header class="main-header">
                <!-- Logo -->
                <a href="{{ url('/auth/success')}}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>PTS</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Psychometric </b> Testing System</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            @if(!Auth::check())
                            <li><a href="{{ url('/home')}}">Home</a></li>
                            <li><a href="{{ url('/register')}}">Register</a></li>
                            <li><a href="{{ url('/login')}}">Login</a></li>
                            @endif

                            @if(Auth::check() && Auth::user()->is_admin)
                            <li><a href="{{ url('/admin/sync')}}"><i class="fa fa-refresh"></i> Sync</a></li>

                            <li><a href="{{ url('/test/create')}}">Create Test</a></li>
                            <li><a href="{{ url('/user')}}">Candidates</a></li>
                            <li><a href="{{ url('/admin/reports')}}">Reports</a></li>

                            @endif


                            @if(Auth::check())
                            <li><a href="{{ url('/test')}}">Tests</a></li>
                            <li><a href="{{ url('/user',[Auth::user()->id])}}">{{ Auth::user()->name }}</a></li>
                            <li><a href="{{ url('/change/password')}}">Change Password</a></li>
                            <li><a href="{{ url('/logout')}}">Logout</a></li>
                            @endif



                        </ul>
                    </div>
                </nav>
                @yield('test_menu')
            </header>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                <div growl ttl="1000"></div>

                @yield('content_header')
                <!-- Main content -->
                <section class="content">
                     @if (session('sync_update'))
                        <div ng-show=sync_modal_open class="modal fade in" id="modal-default" style="display: block; padding-right: 17px;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center">Sync</h4>
              </div>
              <div class="modal-body">
                <h1 class="text-center fa-5x text-success"><i class="fa fa-check-square"></i></h1>
                <p class="text-center text-bold">{{ session('sync_update')}}</p>
              </div>
              <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-default" data-dismiss="modal" ng-click=sync_modal_open=false>Close</button>
                </center>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
                    @endif

                    @yield('content')

                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright © ALCORE PSYCHOMETRIC TESTING SYSTEM <?php echo date("Y") ?></strong> All rights
                reserved.
            </footer>
        </div>
        <!-- ./wrapper -->
        <!-- AngularJS -->
        <!-- jQuery 3 -->
        <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('dist/js/angular.min.js')}}"></script>
        <script src="{{asset('app/app.js')}}"></script>
        <script src="{{asset('dist/js/lib/angular-growl.min.js')}}"></script>

        <!-- Bootstrap 3.3.7 -->
        <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        
        <!-- pace -->
        <script src="{{asset('bower_components/PACE/pace.min.js')}}"></script>
        <!-- SlimScroll -->
        <script src="{{asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <!-- ChartJS -->
        <script src="{{asset('bower_components/Chart.js/Chart.js')}}"></script>
        <!-- FastClick -->
        <script src="{{asset('bower_components/fastclick/lib/fastclick.js')}}"></script>

        <!-- Timing Scripts -->
        <script src="{{asset('bower_components/moment/min/moment.min.js')}}"></script>
        <script src="{{asset('bower_components/angular-timer-master/dist/_timer.js')}}"></script>
        <script type="text/javascript" src="{{asset('bower_components/angular-timer-master/dist/assets/js/angular-timer-bower.js')}}"></script>
        <script type="text/javascript" src="{{asset('bower_components/angular-timer-master/dist/assets/js/angular-timer-all.min.js')}}"></script>


        <!-- AdminLTE App -->
        <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{asset('dist/js/demo.js')}}"></script>
        <script>
            $(document).ready(function () {
                $('.sidebar-menu').tree()
            });
            $(document).ajaxStart(function () {
                Pace.restart();
            });
        </script>

        <script>
            $(function () {
                /* ChartJS
                 * -------
                 * Here we will create a few charts using ChartJS
                 */

                //-------------
                //- BAR CHART -
                //-------------
                var c_scores = $("#chart-scores").val();

                var c_names = $("#chart-names").val();

                

                var areaChartData = {
                    labels: JSON.parse(c_names),
                    datasets: [
                        {
                            label: 'Digital Goods',
                            fillColor: 'rgba(60,141,188,0.9)',
                            strokeColor: 'rgba(60,141,188,0.8)',
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: JSON.parse(c_scores)
                        }
                    ]
                }

                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChart = new Chart(barChartCanvas)
                var barChartData = areaChartData;

                var barChartOptions = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: true,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke: true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth: 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing: 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing: 1,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to make the chart responsive
                    responsive: true,
                    maintainAspectRatio: true
                }

                barChartOptions.datasetFill = false
                barChart.Bar(barChartData, barChartOptions)
            })



        </script>


        <script type="text/javascript">

            var c_scores = $("#chart-scores").val();

            var c_names = $("#chart-names").val();
            console.log(JSON.parse(c_names));
            var radarChartData = {
                labels: JSON.parse(c_names),
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(220,220,220,0.6)",
                        strokfillColor: "rgba(151,187,205,0.8)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: JSON.parse(c_scores)
                    }
                ]
            };

            window.onload = function () {
                window.myRadar = new Chart(document.getElementById("radar-canvas").getContext("2d")).Radar(radarChartData, {
                    responsive: true
                });
            }
        </script>
        

    </body>
</html>
