@extends('layouts.app')

@section('content')
<section class="content-header">
      <h1 class="text-center text-light" style="font-size:40px">
        Create New Test
      </h1>
      <h5 class="text-center text-bold">The Create Test Wizard will help you create a test in no time.</h5>
      <br/>
    </section>
<div class="col-lg-6 col-lg-offset-3">
  <div class="box box-default">
            <form  method="post" action="{{ url('/test')}}">
               {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="e.g Numeric Reasoning">
                  
                   @if ($errors->has('name'))
                    <span class="help-block text-bold text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="">Short Description</label>
                  <textarea type="text" name="description" class="form-control" rows=5></textarea>
                    @if ($errors->has('description'))
                    <span class="help-block text-bold text-danger">{{ $errors->first('description') }}</span>
                  @endif
                
                </div>


                 <div class="form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Duration in minutes</label>
                  <input type="number" class="form-control" name="duration" placeholder=30>
                  
                   @if ($errors->has('duration'))
                    <span class="help-block text-bold text-danger">{{ $errors->first('duration') }}</span>
                  @endif
                </div>


                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    
</div>
@endsection
