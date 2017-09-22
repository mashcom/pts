@extends('layouts.app')
@section('test_menu')

<section class="content-header bg-orange" ng-cloak>
      <h4 class="text-center" style="font-size:16px">
        {{ $test_info->name}}
      </h4>
      <h4 class="text-center text-bold"><i class="fa fa-clock-o fa-spin"></i> 
        <timer id="timer-div" countdown={{$time_in_sec}} max-time-unit="'hour'" interval="1000" finish-callback="finished()">@{{hhours}} hour@{{hoursS}} ,@{{mminutes}} minute@{{minutesS}}, @{{sseconds}} second@{{secondsS}}</timer>
      </h4>                
</section>

@endsection

@section('content')



<div class="col-lg-8 col-lg-offset-2 form-group" ng-show=!timer_finished ng-cloak><br/><br/><br/><br/>
  
<div>
    <input id="max_qns" value={{$questions->count()}} type='hidden'/>
    <input id="active_test" value={{$test_info->id}} type='hidden'/>
    <center>
    <div class="btn-group" ng-show=!timer_finished>
      @foreach($questions as $k=>$q)
          <button type="button" class="btn btn-default text-bold" ng-click=active_qn={{$k}};completed=false>{{$k+1}}</button>
      @endforeach
    </div>
    <br/><br/>
  </center>
    @foreach($questions as $k=>$q)

    <form ng-show=active_qn=={{$k}}>
      @if($q->illustration !="")
       <img class='illustration-img' src=<?php echo "http://localhost/laravel/blog/storage/app/".$q->illustration ?>>
      @endif
    <div class="radio">
        <h4 class="text-black">Question @{{active_qn+1}}) {{$q->content}}</h4>
        @foreach(json_decode($q->answers) as $key=>$answer) 
        <label>
            <input type="radio" name="optionsRadios" value="{{$key}}" ng-click = updateSelected("{{$key}}")><b>{{$key}}</b>: {{$answer}}</input>
        </label>
      <br/>
        @endforeach
    </div>
      <button class="btn btn-md btn-primary text-bold" ng-click=previous()><i class="fa fa-angle-left"></i> Previous</button>
      <button class="btn btn-md btn-warning text-bold" ng-click=skip({{$q->id}})><i class="fa fa-step-forward"></i> Skip</button>
      <button class="btn btn-md btn-success text-bold" nd-class="{'disabled': !active_answer}" ng-click=saveAnswer({{$q->id}})><i class="fa fa-angle-right"></i> Next</button>
	</form>
 

    @endforeach
  </div>
</div>

<div class="error-page" ng-show=completed>
        <h2 class="headline text-purple"> <i class="fa fa-check-square"></i></h2>

        <div class="error-content">
          <h3> Completed</h3>

          <p>
          You have reached the end of the test, wish you the best.
          </p>

          <p ng-show=!timer_finished>You still have time to revise some questions, simply click the question number on the top question navigator.</p>

          <a class="btn btn-lg btn-primary text-bold" href="../test"><i class="fa fa-eye"></i>View Tests</a>
        </div>
        <!-- /.error-content -->
      </div>


      <div class="error-page" ng-show=timer_finished>
        <h2 class="headline text-gray"> <i class="fa fa-clock-o"></i></h2>

        <div class="error-content">
          <h3> Time Up!</h3>

          <p>
          You have reached the end of your allowed time.
          </p>

          <a class="btn btn-lg btn-primary text-bold" href="../test"><i class="fa fa-eye"></i>View Other Tests</a>
        </div>
        <!-- /.error-content -->
      </div>


@endsection
