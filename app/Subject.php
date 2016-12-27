<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
	protected $fillable=[
    'name','subject_code','course_id','semester','credit','fullmark','passmark','ia_fullmark','revised_year','old_course',
    ];

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
