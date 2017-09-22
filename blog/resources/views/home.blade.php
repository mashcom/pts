@extends('layouts.app')

@section('content')

<div class="col-lg-10 col-lg-offset-1">

    <div class="error-page">
        <h2 class="headline text-gray"> <i class="fa fa-lightbulb-o"></i></h2>

        <div class="error-content">
          <h3> Welcome <b>{{ Auth::user()->name}}</b></h3>

          <p>
            Welcome to the Psychometric Testing System, please choose the options below to start a new test or view results of your previous tests
          </p>

          <a class="btn btn-lg btn-primary text-bold" href="{{ url('/test')}}">View Available Tests</a>
          </div>
        <!-- /.error-content -->
      </div>

</div>
@endsection
