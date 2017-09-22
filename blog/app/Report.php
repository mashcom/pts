<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    
	protected $guarded = [];
	
    public function test()
    {
    	return $this->belongsTo('App\Test','test_id','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
}
