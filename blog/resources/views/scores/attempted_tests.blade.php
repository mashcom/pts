@extends('layouts.app')

@section('content')

@if(sizeof($scores) ==0)
<div class="error-page">
    <h2 class="headline text-yellow"> <i class="fa fa-comment"></i> </h2>

    <div class="error-content">
        <br/>
        <h2 class="text-bold">Oops. No attempts!</h2>

        <p>
            This user has not attempted any tests so far
        </p>


    </div>
    <!-- /.error-content -->
</div>

@endif

@if(sizeof($scores) > 0)
<div class="col-lg-10 col-lg-offset-1">

    <section class="content-header">
        <h1 class="text-center text-light" style="font-size:40px">
            {{ $user->name }} :Report
        </h1>
        
        <br/>
        
    </section>
    <div class="col-md-3 pull-left">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{asset('dist/img/fr-05.jpg')}}">

              <h3 class="profile-username text-center">Nina Mcintire</h3>

                <h5 class="text-bold">Education: {{$user->education}}</h5>
                <h5 class="text-bold">Sex: {{$user->sex}}</h5>
                <h5 class="text-bold">DOB: {{$user->dob}}</h5>
                <h5 class="text-bold">Employment Type: {{$user->employment_type}}</h5>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
<div class="col-lg-9 pull-right">
    <div class="box-body">
        @if($scores->count()>2)
        <div class="chart">
            <canvas id="radar-canvas" style="height:430px"></canvas>
        </div>
        @endif
    </div>
    <div class="box">
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table table-striped">
                <tbody><tr>
                        <th style="width:25%">Name</th>
                        <th>Description</th>
                        <th>Score</th>
                        <th></th>
                    </tr>
                    <?php
                    /**
                     * Create data to be appended to the graph
                     */
                    $chart_names = array();
                    $chart_scores = array();
                    ?>
                    @foreach($scores as $s)

                    <tr>
                        <td><b>{{$s->test->name}}</b></td>
                        <td>{{ $s->test->description}}</td>
                        <td class="text-bold" style="font-size:40px;">
                            <?php
                            $total = $s->correct + $s->incorrect + $s->skipped;

                            $percentage = ($s->correct / $total) * 100;

                            array_push($chart_scores, (int) $percentage);
                            array_push($chart_names, $s->test->name);

                            echo (int) $percentage . "%";
                            ?>
                        </td>
                        <td><a class="btn btn-sm btn-primary" href=<?php echo url('/admin/score/report/' . $s->test_id . "/" . $user->id) ?>>View</a></td>
                    </tr>
                    @endforeach
                </tbody></table>

            <input type="hidden" value="<?php echo json_encode($chart_scores); ?>" id="chart-scores" />
            <input type="hidden" value='<?php echo json_encode($chart_names); ?>' id="chart-names" />

        </div>
        <!-- /.box-body -->
    </div>
</div>

</div>

@endif
@endsection
