<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
	protected $fillable=['student_id','doc_name','file_name'];

    public function student(){
    	return $this->belongsTo('App\Student');
    }
}
