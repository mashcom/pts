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
        <div class="box">
            <div class="box-header">
                <h1 class="box-title">Candidates</h1>


            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <table class="table">
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
                            <td><a href="<?php echo "admin/single/report/".$u->id ?>" class="btn btn-sm btn-primary">Report</a></td>
                        </tr>

                        @endforeach


                    </tbody></table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
