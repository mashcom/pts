<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Test extends Model
{
    
    public function questions()
    {
    	return $this->hasMany('App\TestQuestion','test_id','id');
    }
    
}
