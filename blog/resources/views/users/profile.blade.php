@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center" style="font-size:40px">
        User Profile
      </h1>
      
<div class="modal fade in" id="modal-default">
      <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Profile</h4>
              </div>
              <div class="modal-body">
                <div>
            <div class="panelj panel-default">
               
                <div class="panel-bodyk">
                    <form class="form-horizontal" role="form" method="POST">
                        
                        <input type="hidden" id="update_token" value={{ csrf_token() }}>
                          <input type="hidden" id="update_id" value={{ $user->id }}>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="update_name" type="text" class="form-control" name="name" value="{{ $user->name}}">

                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="update_email" type="email" class="form-control" name="email" value="{{ $user->email }}">

                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sex') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Sex</label>

                            <div class="col-md-6">
                                <select id="update_sex" class="form-control" name="sex">
                                    <option></option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>

                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Date of Birth</label>

                            <div class="col-md-6">
                                <input id="update_dob" type="date" class="form-control" name="dob" value="{{$user->dob}}">

                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('education') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Academic Qualification(s)</label>

                            <div class="col-md-6">
                                <textarea id="update_education" class="form-control" name="education">{{ $user->education }}</textarea>

                                
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('employment_type') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Employment Type</label>

                            <div class="col-md-6">
                                <select id="update_employment_type" class="form-control" name="employment_type">
                                    <option selected></option>
                                    <option>internship</option>
                                    <option>permanent</option>
                                    <option>part-time</option>
                                    <option>management</option>
                                </select>

                                
                            </div>
                        </div>
                    </form>

                    <ul>
                      <li class="text-bold text-danger" ng-repeat="i in errors">@{{i[0]}}</li>
                    </ul>
                </div>
            </div>
        </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" ng-click=updateProfile()>Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </div>
  <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/fr-05.jpg')}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$user->name}}</h3>

              <p class="text-bold text-center"><i class="fa fa-venus"></i>{{$user->sex}}</p>
              @if(Auth::user()->id == $user->id)
            <button type="button" class="btn btn-lg btn-block bg-purple" data-toggle="modal" data-target="#modal-default">
                Edit Profile
              </button>
              @endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
</div>
<div class="col-lg-9">
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About {{$user->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

              <p class="text-muted">
                {{$user->education}}
              </p>

              <hr>

              <strong><i class="fa fa-envelope-o margin-r-5"></i> Email</strong>

              <p class="text-muted">
                {{$user->email}}
              </p>

              <hr>



              <strong><i class="fa fa-leaf margin-r-5"></i> Employment Type</strong>

              <p class="text-muted">{{$user->employment_type}}</p>

              <hr>

               </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
</div>
@endsection
