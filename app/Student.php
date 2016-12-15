<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function course(){
    	return $this->belongsTo('App\Course');
    }

    public function community(){
    	return $this->belongsTo('App\Community');
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }
//tags
    public function subjects(){
        return $this->belongsToMany('App\Subject');
    }


/////////////
    

}
