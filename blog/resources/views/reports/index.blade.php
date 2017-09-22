@extends('layouts.app')

@section('content')
<section class="content-header">
    <h3 class="text-center text-light" style="font-size:40px">
        Reports Dashboard
    </h3>
    <h5 class="text-center text-bold col-lg-6 col-lg-offset-3">A quick glimpse of whats going on</h5>
    <br/>
</section>

<div class="col-lg-10 col-lg-offset-1">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th  class="col-lg-3">Name</th>
                <th  class="col-lg-6">Description</th>
                <th  class="col-lg-1">Questions</th>
                <th><i class="fa fa-clock-o"></i> Created</th>
                <th></th>
            </tr>

            @foreach($report as $r)
            <tr>
                <td class="text-bold">{{ $r->name }}</td>
                <td>{{ $r->description }}</td>
                <td class="h3 text-bold">{{ $r->questions->count() }}</td>
                <td>{{ $r->created_at }}</td>
                <td><a href=<?php echo "compile/report/" . $r->id ?> class="btn btn-xs btn-primary">More <i class="fa fa-ellipsis-h"></i></a></td>
            </tr>
            @endforeach

        </tbody></table>
</div>
@endsection
