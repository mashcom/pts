<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;
use Storage;

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

    public function updateAvatar(Request $request)
    {
        $User = User::find(Auth::user()->id);
        $this->validate($request, [
            'avatar'=>"required|image"
        ]);

        //dd($request);

        if ($request->file('avatar') != null) {
            $file_name = "avatar_" . sha1(rand(1, 100000000000000000)) . sha1(rand(1, 100000000000000000)) . "." . $request->file('avatar')->getClientOriginalExtension();
            Storage::put($file_name, file_get_contents($request->file('avatar')->getRealPath()));

            $User->avatar = $file_name;
            $User->save();
            return redirect()->back()->with(["success"=>"Profile picture changeid successfully"]);
        }

        return redirect()->back()->withError(["avatar"=>"Profile picture changing failed, please try again"]);
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
                    'name' => 'required|max:255',
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
