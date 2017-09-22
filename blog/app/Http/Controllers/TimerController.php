<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Timer;
use Auth;
use App\Test;
use App\Http\Requests;

class TimerController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $user = Auth::user()->id;
        $test_id = $request->test_id;

        $test_info = Test::find($test_id);
        $expiry = Carbon::now()->addMinute($test_info->duration);

        $save = Timer::updateOrCreate(['user_id' => $user, 'test_id' => $test_id], ['expiry_time' => $expiry]);

        $record = Timer::where('user_id', $user)
                ->where('test_id', $test_id)
                ->first();

        return Carbon::now()->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s', $record->expiry_time));
    }

}
