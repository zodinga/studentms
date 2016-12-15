<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Student;
use App\Course;
use App\Student_subject;

class PublicController extends Controller
{
    public function getIndex($filter){
    	
    	$stat="All";
    	if($filter==0)
    	{
    		$students=Student::where('id','>',$filter)->orderby('created_at','desc')->paginate(8);
    	}
    	else
    	{
    		$students=Student::where('status_id','=',$filter)->orderby('created_at','desc')->paginate(8);
    		if($students->total()<>0)
	    		$stat=$students->first()->status->name;
    	}

    	return view('public.index')->withStudents($students)->withStat($stat);	
    }

    public function getSingle($id){
    	
    	$student=Student::where('id','=',$id)->first();
        $student_subjects=Student_subject::where('student_id','=',$student->id)->get();

    	return view('public.single')->withStudent($student)->with('student_subjects',$student_subjects);
    }

    public function getSearch(Request $request)
    {
        
        $students=Student::where('id','>',0);
        if($request->has('name'))
            $students=$students->where('name','like','%'.$request->name.'%');
        if($request->has('course_id'))
        {
            $students=$students->where('course_id','=',$request->course_id);
        }
        if($request->has('year'))
            $students=$students->where('doj','=',$request->year);

        $students=$students->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('public.index')
                    ->withCourses($courses)
                    ->withStudents($students)
                    ->withStat('Filtered ');
    }


}
