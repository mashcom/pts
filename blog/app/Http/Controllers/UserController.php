<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users= User::all();
        return view('users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
    
        return view('users.profile',["user"=>$user]);
    }

    public function resetPassword(Request $request){
        if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $request->current_password])) {
            return redirect()->back()->withErrors(["current_password"=>"This password does not match the current password"]);
        }
    
         $this->validate($request, [
           'password' => 'required|min:6|confirmed',
        ]);

        $update = User::find(Auth::user()->id);
        $update->password = bcrypt($request->password);

        if($update->save()){
            return redirect()->back()->with(["success"=>"Password updated successfully"]);
        }
        return redirect()->back()->withErrors(["failed"=>"Password failed to update"]);
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

        $User = User::find($id);
        $this->validate($request, [
                    'name' => 'required|alpha|max:255',
                    'email' => 'required|email|max:255|unique:users,email,'.$User->id,
                    'sex' => 'required',
                    'dob' => 'required|date|before:01/01/2001',
                    'education' => 'required',
                    'employment_type' => 'required',
        ]);

        
        $User->name = $request->name;
        $User->email = $request->email;
        $User->sex = $request->sex;
        $User->dob = $request->dob;
        $User->education = $request->education;
        $User->employment_type = $request->employment_type;

        if($User->save()){
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
    public function destroy($id)
    {
        //
    }
}
