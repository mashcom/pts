@extends('layouts.app')

@section('content')

<div class="col-lg-10 col-lg-offset-1">
    <section class="content-header">
      <h1 class="text-center text-light" style="font-size:40px">
        Available Tests
      </h1>
      <h5 class="text-center text-bold">The following tests are available for you to try.</h5>
      <br/>
    </section>

@if(isset($success))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Success</h4>
       {{ $success }}
    </div>
@endif
    
@foreach($tests as $test)
<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    
    <div class="small-box bg-blue">
        <div class="inner">
            <h1></h1>
            <p class='text-bold'>{{$test->name}}</p>
        </div>
        <div class="icon">
            <i class="ion ion-ios-book-outline"></i>
        </div>
        
        <a href={{ url("init/test",[$test->id]) }} class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
    </div>

</div>

 @endforeach
</div>
@endsection
