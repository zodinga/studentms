<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_subject extends Model
{
	protected $table='student_subject';

	public function subject(){
        return $this->belongsTo('App\Subject');
    }

    public function result(){
        return $this->hasOne('App\Result','student_subject_id');
    }

}
