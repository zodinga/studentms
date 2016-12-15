<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public function course(){
    	return $this->belongsTo('App\Course');
    }
    
    public function students(){
    	return $this->belongsToMany('App\Student');
    }

    public function student_subjects(){
    	return $this->hasMany('App\Student_subject');
    }

}
