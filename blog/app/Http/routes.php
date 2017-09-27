<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	if(Auth::check()){
		return redirect('/auth/success');
	}
    return view('welcome');
});

Route::auth();


Route::group(['middleware'=>'auth'],function(){
	Route::get('/home', 'HomeController@index');
	Route::resource('/test','TestController');
	Route::get('/init/test/{id}','TestController@initTest');
	Route::resource('/score','ScoreController');
	Route::resource('/user','UserController');
	Route::post('/update/avatar','UserController@updateAvatar');
	Route::resource('/timer','TimerController');
	Route::get('/change/password',function(){
		return view("auth.passwords.change");
	});
	Route::get('http://localhost/laravel/blog/storage/app/',function(){
		return asset('dist/img/fr-05.jpg');
	});
	Route::post('/change/password', 'UserController@resetPassword');

	Route::group(['middleware'=>'admin'],function(){
		Route::resource('/admin/test','TestQuestionController');
		Route::resource('/admin/reports','ReportController');
		Route::get('/admin/test_report/{test_id}/user/{user_id}','ScoreController@show');
		Route::get('/admin/compile/report/{id}','ReportController@compile');
                Route::get('/admin/single/report/{id}','ReportController@userTests');
		Route::get('/admin/sync','ReportController@syncReports');
		Route::post('/admin/delete_qn/{id}','TestQuestionController@destroy');
                Route::get('/admin/score/report/{test_id}/{user_id}','ScoreController@show');
	});

	Route::get('/auth/success',function(){
		if(Auth::user()->is_admin){
			return view('admin.index');
		}
		else{
			return redirect('/home');
		}
	});

});
