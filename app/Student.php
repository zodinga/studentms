<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable=[
    'name','aadhaar','eid','phone','email','inst_no','univ_reg_no','exam_roll_no','doj',
    'course_id','batch','fathers_me','mothers_me','parents_phone','guardian_me','guardian_phone',
    'dob','sex','category_id','community_id',
    'per_street','per_city','per_district','per_state','per_pin',
    'pre_street','pre_city','pre_district','pre_state','pre_pin',
    'status_id','status_update_date','photo',
    ];

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
        return $this->belongsToMany('App\Subject')->orderBy('semester');
    }


/////////////
    public function registrations(){
        return $this->hasMany('App\Registration')->orderBy('semester','DESC');
    }
    
    public function documents(){
        return $this->hasMany('App\Document');
    }
}
