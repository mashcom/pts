@extends('layouts.app')

@section('content')

<section class="content-header">
    <h1 class="text-center">
        Candidates
    </h1>      
    <h4 class="text-center text-bold">View candidate performance in different tests</h4> 
</section>
<div class="container">
    <div class="col-md-12">
        <div class="boxfg">
            <div class="box-header">


            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding"><!--
                <table class="table table-striped">
                    <tbody><tr>
                            <th>NAME</th>
                            <th>SEX</th>
                            <th>DOB</th>
                            <th>EDUCATION</th>
                            <th>EMPLOYMENT_TYPE</th>
                            <th>EMAIL</th>
                            <th></th>
                        </tr>

                        @foreach($users as $u)
                        <tr>
                            <td><b>{{ $u->name }}</b></td>
                            <td>{{ $u->sex }}</td>
                            <td>{{ $u->dob }}</td>
                            <td>{{ $u->education }}</td>
                            <td>{{ $u->employment_type }}</td>
                            <td>{{ $u->email }}</td>
                            <td><a href="<?php echo "admin/single/report/".$u->id ?>" class="btn btn-xs btn-primary">Report</a></td>
                        </tr>

                        @endforeach


                    </tbody></table>-->
                    @foreach($users as $u)
                    <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-orange" style="background: url('{{asset('dist/img/photfo4.jpg')}}') center center;">
              <h3 class="widget-user-username">{{ $u->name }}</h3>
              <h5 class="widget-user-desc">{{ $u->email }}</h5>
            </div>
            <div class="widget-user-image">
              <?php
              $avatar_pic;
              if(!empty($u->avatar)){
               $avatar_pic= "http://localhost/laravel/blog/storage/app/".$u->avatar;
            }
            else{
               $avatar_pic= asset('dist/img/fr-05.jpg');
            }
              ?>
              <img class="img-circle" src=<?php echo $avatar_pic?> alt="User Avatar">
              <br><br>
            </div>
            <div class="box-footer">
              <div class="row">
              
                <!-- /.col -->
                <div class="col-sm-12">
                   <a href="<?php echo "admin/single/report/".$u->id ?>" class="btn btn-lg  btn-default text-bold btn-block">Report</a>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
         @endforeach
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
