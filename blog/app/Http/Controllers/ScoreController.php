<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Score;
use App\Test;
use Auth;
use App\User;
use App\Http\Requests;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = Score::with('test','report','user')->where("user_id",Auth::user()->id)->get();
        $attampted = $scores->unique('test_id');
        return view('scores.attempted_tests',["scores"=>$attampted]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Score = new Score();
        $current_record = Score::where("test_id",$request->test_id)->where("question_id",$request->question_id)->where("user_id",Auth::user()->id)->delete();
      
        if($Score->firstOrCreate(["test_id"=>$request->test_id,
            "question_id"=>$request->question_id,
            "answer"=>$request->answer,
            "user_id"=>Auth::user()->id])){
            return "true";
        }
        return "false";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$user)
    {   
       
        
        $scores = Score::with('question')->where("test_id",$id)
        ->where("user_id",$user)
        ->get();

        $user_info = User::find($user);

        $skipped = Score::where("test_id",$id)
        ->where("user_id",$user)
        ->where("answer","skipped")->count();


        $test_info = Test::find($id);
        return view("tests.score",["user_info"=>$user_info,"scores"=>$scores,"skipped_count"=>$skipped,"test_info"=>$test_info]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
