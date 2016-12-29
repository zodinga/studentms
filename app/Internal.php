<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Internal extends Model
{
    public function student_subject(){
    	return $this->belongsTo('App\Student_subject','student_subject_id','id');
    }
}
