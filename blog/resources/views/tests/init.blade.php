@extends('layouts.app')
@section('test_menu')
@endsection

@section('content')

@if(sizeof($questions) ==0 && !Auth::user()->is_admin)
	<div class="error-page">
        <h2 class="headline text-yellow"> <i class="fa fa-warning text-yellow"></i> </h2>

        <div class="error-content">
          <h3>Oops! No questions for you.</h3>

          <p>
           This test has no questions associated with it, if you believe this is an error please contact your administrator
          </p>
        </div>
        <!-- /.error-content -->
      </div>
@endif 


<div class="col-lg-8 col-lg-offset-2 form-group" ng-show=!timer_finished ng-cloak><br/><br/><br/><br/>
    <div class="error-page" >
        <h2 class="headline text-gray"> <i class="fa fa-balance-scale"></i></h2>

        <div class="error-content">
          <h3 class="text-bold" style="font-weight:bold !important">{{ $test_info->name }}</h3>
          
           <p>
          {{ $test_info->description }}
          </p>

          <p>Once you click <b>start</b> button the clock will start cannot be stopped and your previous attempt will be trashed</p>

          <h4 style="font-weight:bold !important">Time: {{ $test_info->duration }} minutes</h4>
          
          @if(!Auth::user()->is_admin)
            <button class="btn btn-md btn-primary text-bold" ng-click=startTest()>Start <i class="fa fa-play"></i></button>
          @endif

          @if(Auth::user()->is_admin)
           <a href={{ url("/admin/reports",[$test_info->id])}} class="btn btn-md btn-success text-bold"><i class="fa fa-book"></i> Report</a>
         
          <a href={{ url("/admin/test",[$test_info->id])}} class="btn btn-md btn-danger text-bold"><i class="fa fa-edit"></i> Edit Questions </a>
          <a data-toggle="modal" data-target="#edit-default" class="btn btn-md btn-info text-bold"><i class="fa fa-book"></i> Edit Test</a>
          

          @endif
        </div>
        <input type="hidden" ng-bind="active_test" value={{$test_info->id}} id="active_test">
        <!-- /.error-content -->
      </div>
</div>

<form class="modal fade in" id="edit-default">
  <input type="hidden" name="_token" id="edit_token" value="{{csrf_token()}}">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Test Info</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" id="edit_name" name="name" placeholder="e.g Numeric Reasoning" value="{{$test_info->name}}">
                  
                                   </div>

                <div class="form-group">
                  <label for="">Short Description</label>
                  <textarea type="text" id="edit_description" name="description" class="form-control" rows="5">{{$test_info->description}}</textarea>
                                    
                </div>


                 <div class="form-group">
                  <label for="exampleInputEmail1">Duration in minutes</label>
                  <input type="number" id="edit_duration" class="form-control" name="duration" placeholder="30" value={{$test_info->duration}}>
                  
                                   </div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click=updateTest()>Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </form>
          <!-- /.modal-dialog -->
        </div>
@endsection
