@extends('layouts.app')

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <div class="error-page">
        <h2 class="headline text-gray"> <i class="fa fa-lightbulb-o"></i></h2>

        <div class="error-content">
          <h2 class="text-bold"> Welcome Administrator</h2>

          <p>
            Welcome to the Psychometric Testing System, please choose the options below to start a new test or view results of your previous tests
          </p>

          <p>To make sure data is up-to-date before viewing reports always <b>SYNC</b> the system</p>

          <a class="btn btn-lg btn-primary text-bold" href="{{ url('/test')}}">View Available Tests</a>
          <a class="btn btn-lg btn-primary text-bold" href="{{ url('/admin/sync')}}"><i class="fa fa-refresh"></i> Sync System Data</a>

        </div>
        <!-- /.error-content -->
      </div>

</div>
@endsection
