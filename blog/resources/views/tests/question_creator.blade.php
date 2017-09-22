@extends('layouts.app')

@section('content')
<section class="content-header">
      <h1 class="text-center text-light" style="font-size:40px">
        {{ $test->name }}
      </h1>
      <h5 class="text-center text-bold col-lg-6 col-lg-offset-3">{{ $test->description }}</h5>
      <br/><br><br><br><br>
    </section>

    <div class="modal modal-warning fade" id="delete_modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Question</h4>
              </div>
              <div class="modal-body">
                <p>You about to delete a question, this process is not reversible once you procceed. Are you sure?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-outline" data-dismiss="modal" ng-click=deleteQuestion()> Yes, Delete</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<div class="col-lg-12">
  <div class="col-lg-7">
    
    @if(sizeof($questions) ==0)
    <div class="error-page">
        <h2 class="headline text-yellow"> <i class="fa fa-bell text-gray"></i> </h2>

        <div class="error-content">
          <h3>Ooops! No questions yet</h3>

          <p>
           This test has no questions associated with it, you can start adding questions.
          </p>
        </div>
        <!-- /.error-content -->
      </div>
    @endif 


    @foreach($questions as $k=>$q)

      @if($q->illustration !="")
       <img class='illustration-img' src=<?php echo "http://localhost/laravel/blog/storage/app/".$q->illustration ?>>
      @endif
    <div class="radio">
        <h4>Question {{$k+1}}</h4>
        <p class="text-black h5">{{$q->content}}</p>
        @foreach(json_decode($q->answers) as $key=>$answer) 
        <label>
            <input type="radio" disabled name="optionsRadios" value="{{$key}}"><b>{{$key}}</b>: {{$answer}}</input>
            <?php 
                if($key == $q->correct_answer){ 
                  echo "<i class='fa fa-check-square text-success text-bold'> correct</i>"; 
                } 
            ?>
        </label>
      <br/>
        @endforeach
    </div>
      <button data-toggle="modal" data-target="#delete_modal" ng-click=activateDialog(<?php echo $q->id ?>) class="btn btn-md btn-danger text-bold"><i class="fa fa-times"></i> Delete</button>
      <button ng-click=getQuestion(<?php echo $q->id ?>) class="btn btn-md btn-primary text-bold"><i class="fa fa-edit"></i> Edit</button>
     
 
 <br/><br/><br/>

    @endforeach
  </div>

  <!--input-->
  <div class="box box-default col-lg-5" style="width:41% !important">
     @if (session('success'))
            <div class="callout callout-success">
                <h4>Success!</h4>

                <p>{{ session('success') }}</p>
              </div>
        @endif
             <form  method="post" action="{{ url('/admin/test')}}" enctype="multipart/form-data">
               {{ csrf_field() }}
              <div class="box-body">
                 <input type="hidden" class="form-control" name="id" value={{$test->id}}>
                 <input type="hidden" class="form-control" name="edit_mode" ng-value=is_edit_mode>
                 <input type="hidden" class="form-control" name="edit_id" ng-value=active_qn>
                
                
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                  <label for="exampleInputEmail1">Question</label>
                  <textarea rows=5 type="text" class="form-control" name="content">@{{ active_edit.content }}</textarea>
                   @if ($errors->has('content'))
                    <span class="help-block text-bold text-danger">{{ $errors->first('content') }}</span>
                  @endif
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Possible Answers</label>
                  <div class="input-group">
                    <span class="input-group-addon text-bold">A</span>
                      <input type="text" name="a" class="form-control" ng-value=edit_parsed_answer.A>
                       @if ($errors->has('a'))
                    <span class="help-block text-bold text-danger">{{ $errors->first('a') }}</span>
                  @endif
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon text-bold">B</span>
                      <input type="text" name="b" class="form-control" ng-value=edit_parsed_answer.B>
                       @if ($errors->has('b'))
                    <span class="help-block text-bold text-danger">{{ $errors->first('b') }}</span>
                  @endif
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon text-bold">C</span>
                      <input type="text" name="c" class="form-control" ng-value=edit_parsed_answer.C>
                       @if ($errors->has('c'))
                    <span class="help-block text-bold text-danger">{{ $errors->first('c') }}</span>
                  @endif
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon text-bold">D</span>
                      <input type="text" name="d" class="form-control" ng-value=edit_parsed_answer.D>
                       @if ($errors->has('d'))
                    <span class="help-block text-bold text-danger">{{ $errors->first('d') }}</span>
                  @endif
                  </div>
                   <div class="input-group">
                    <span class="input-group-addon text-bold">E</span>
                      <input type="text" name="e" class="form-control" ng-value=edit_parsed_answer.E>
                  </div>

                 </div>


                <div class="form-group">
                  <label for="">Correct Answer</label>
                   <select  class="form-control" name="correct_answer">
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>D</option>
                    <option>E</option>
                   </select>
               
                </div>

                <div class="form-group">
                  <label for="exampleInputFile">Illustration</label>
                  <input type="file" name="illustration">

                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-lg btnf-block">Save Changes</button>
              </div>
            </form>
          </div>
    
</div>
@endsection
