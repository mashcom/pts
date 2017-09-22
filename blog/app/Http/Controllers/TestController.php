<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use App\TestQuestion;
use App\Http\Requests;
use Carbon\Carbon;
use App\Timer;
use Auth;

class TestController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $test_list = Test::all();
        return view('tests.index', ['tests' => $test_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('tests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $Test = new Test();
        $Test->name = $request->name;
        $Test->description = $request->description;
        $Test->duration = $request->duration;

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:800',
            'duration' => 'required|integer|min:0'
        ]);

        if ($Test->save()) {
            return redirect('/test')->with('success', 'You have successfully created the test, Click the test to update it');
        }
        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $test_info = Test::find($id);
        $questions = TestQuestion::where('test_id', $id)->get();

        $record = Timer::where('user_id', Auth::user()->id)
                ->where('test_id', $id)
                ->first();


        $seconds = Carbon::now()->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s', $record->expiry_time));

        return view('tests.single', ['time_in_sec' => $seconds, 'questions' => $questions, "test_info" => $test_info]);
    }
    
    /**
     * Initialise a test
     * @param type $id
     * @return type
     */
    public function initTest($id) {
        $test_info = Test::find($id);
        $questions = TestQuestion::where('test_id', $id)->get();

        return view('tests.init', ['questions' => $questions, "test_info" => $test_info]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $Test = Test::find($id);
        $Test->name = $request->name;
        $Test->description = $request->description;
        $Test->duration = $request->duration;

        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'max:800',
            'duration' => 'required|integer|min:1'
        ]);

        if ($Test->save()) {
            return "true";
        }
        return "false";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
