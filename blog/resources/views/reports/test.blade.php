@extends('layouts.app')

@section('content')

@if(sizeof($report) ==0)
<div class="error-page">
    <h2 class="headline text-yellow"> <i class="fa fa-warning text-yellow"></i> </h2>

    <div class="error-content">
        <h3>Oops. No report found</h3>

        <p>
            This test has no reports make sure there are candidates who have attempted the test
        </p>


    </div>
    <!-- /.error-content -->
</div>

@endif

@if(sizeof($report) > 0)
<section class="content-header">
    <h3 class="text-center text-light" style="font-size:40px">
        {{ $report[0]['test']['name'] }} :Report
    </h3>
    <h5 class="text-center text-bold col-lg-6 col-lg-offset-3">{{ $report[0]['test']['description'] }}</h5>
    <br/>
</section>

<div class="col-lg-8 col-lg-offset-2">

    <div class="box-body">
        <div class="chart">
            <canvas id="barChart" style="height:330px"></canvas>
        </div>
    </div>
    <!-- /.box-body -->

<!-- /.box -->
<table class="table table-bordered">
    <tbody>
        <tr>

            <th><i class="fa fa-user"></i> Candidate</th>
            <th><i class="fa fa-thumbs-up text-success"></i> Correct</th>
            <th><i class="fa fa-thumbs-down text-danger"></i> Wrong</th>
            <th><i class="fa fa-fast-forward text-warning"></i> Skipped</th>
            <th>Total</th>
            <th></th>
        </tr>
        
        <?php  
            /**
             * Create data to be appended to the graph
             */
        
             $chart_names = array();
             $chart_scores = array();
        ?>
        @foreach($report as $r)
        <tr>
            <td class="text-bold">{{ $r->user->name }} ({{$r->user->email}})</td>
            <td><span class="text-bold h4">{{ $r->correct }}</span></td>
            <td>{{ $r->incorrect }}</td>
            <td>{{ $r->skipped }}</td>
            <td class="text-bold" style="font-size:25px;">
                <?php
                $total = $r->correct + $r->incorrect + $r->skipped;
                $percentage = ($r->correct / $total) * 100;
                
                array_push($chart_scores, (int)$percentage);
                array_push($chart_names, $r->user->name."(".$r->user->email.")");
                echo (int) $percentage . "%";
                ?>
            </td>
            <td><a href=<?php echo "../test_report/" . $r->test_id . "/user/" . $r->user->id ?> class="btn btn-xs btn-primary">More <i class="fa fa-ellipsis-h"></i></a></td>
        </tr>
        @endforeach
        
        
    <input type="hidden" value="<?php echo json_encode($chart_scores); ?>" id="chart-scores" />
    <input type="hidden" value='<?php echo json_encode($chart_names); ?>' id="chart-names" />
    </tbody></table>
</div>
</div>

@endif

@endsection
