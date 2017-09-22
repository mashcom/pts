<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
     protected $guarded = [];


     public function question(){
     	return $this->belongsTo('App\TestQuestion','question_id','id');
     }

     public function test(){
     	return $this->belongsTo('App\Test');
     }

     public function report(){
     	return $this->hasOne('App\Report','test_id','test_id');
     }

     public function user(){
     	return $this->hasOne('App\User','id','user_id');
     }
}
