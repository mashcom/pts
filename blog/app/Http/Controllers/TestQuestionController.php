<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Test;
use Storage;
use App\TestQuestion;
use App\Http\Requests;

class TestQuestionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $answers = array("A" => $request->a, "B" => $request->b, "C" => $request->c, "D" => $request->d, "E" => $request->e);

        $this->validate($request, [
            'content' => 'required|max:855',
            'a' => 'required|max:250',
            'b' => 'required|max:250',
            'c' => 'required|max:250',
            'd' => 'required|max:250',
            'correct_answer' => 'required',
        ]);

        $TestQuestion = new TestQuestion();
        $success_msg = "New question added successfully";

        if ($request->edit_mode == true && $request->edit_id != 0) {
            $TestQuestion = TestQuestion::find($request->edit_id);
            $success_msg = "Question Updated Successfully";
        }

        $TestQuestion->content = $request->content;
        $TestQuestion->answers = json_encode($answers);
        $TestQuestion->correct_answer = $request->correct_answer;
        $TestQuestion->test_id = $request->id;



        if ($request->file('illustration') != null) {
            $file_name = "illustration_" . sha1(rand(1, 100000000000000000)) . sha1(rand(1, 100000000000000000)) . "." . $request->file('illustration')->getClientOriginalExtension();
            Storage::put($file_name, file_get_contents($request->file('illustration')->getRealPath()));

            $TestQuestion->illustration = $file_name;
        }
        if ($TestQuestion->save()) {
            return redirect()->back()->with(["success"=>$success_msg]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $questions = TestQuestion::where('test_id', $id)->orderBy('id', 'asc')->get();
        return view("tests.question_creator", ['questions' => $questions, 'test' => Test::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $question = TestQuestion::find($id);
        return $question->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        return TestQuestion::destroy($id);
    }

}
