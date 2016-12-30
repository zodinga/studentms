<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Course;
use App\Student;
use App\Student_subject;

use App\Category;
use App\Status;
use App\Community;

use Excel;

class ReportController extends Controller
{
    public function getRegistration(){
    	$courses=Course::pluck('name','id');

    	return view('reports.registration')->withCourses($courses);
    }

    public function getInternal(){
    	$courses=Course::pluck('name','id');

    	return view('reports.internal')->withCourses($courses);
    }

    public function getResult(){

    	$courses=Course::pluck('name','id');
    	$categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $statuses=Status::pluck('name','id');

    	return view('reports.result')
    						->withCategories($categories)
                            ->withCourses($courses)
                            ->withStatuses($statuses)
                            ->withCommunities($communities);
    }

    public function getExportRegistration(Request $request){

    	$students=Student::join('categories', 'students.category_id', '=', 'categories.id')
				            ->join('courses', 'students.course_id', '=', 'courses.id')
				            ->join('communities', 'students.community_id', '=', 'communities.id')
				            ->join('statuses', 'students.status_id', '=', 'statuses.id')
				            ->leftJoin('registrations','students.id','=','registrations.student_id')
			->select('students.id','students.name','students.phone','students.email','students.sex',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','students.doj as yoj',
				'courses.name as course','students.batch','statuses.name as status',
				'registrations.semester','registrations.session','registrations.year','registrations.receipt_no','registrations.remarks');

			/*
			->select('students.id','students.name','students.aadhaar','students.eid','students.phone','students.email',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','students.doj as yoj',
				'courses.name as course','students.batch','students.fathers_me','students.mothers_me','students.parents_phone',
				'students.guardian_me','students.guardian_phone','students.dob','students.sex','categories.name as category',
				'communities.name as community','students.per_street','students.per_city','students.per_district','students.per_state',
				'students.per_pin','students.pre_street','students.pre_city','students.pre_district','students.pre_state',
				'students.pre_pin','statuses.name as status','students.status_update_date','students.photo');
			*/

    	//->where('id','>',0);
    	$title="";
        if($request->has('name'))
            {
            	$students=$students->where('name','like','%'.$request->name.'%');
            	$title=$request->name." ";
            }
        if($request->has('course_id'))
        	{
            $students=$students->where('course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title.$course->name." ";
        	}
        if($request->has('year'))
            {
            	$students=$students->where('doj','=',$request->year);
            	$title=$title.$request->year." ";
            }
        if($request->has('batch'))
            {
            	$students=$students->where('batch','=',$request->batch);
            	$title=$title.$request->batch." ";
            }

        if($request->has('sex'))
            {
            	$students=$students->where('sex','=',$request->sex);
            	$title=$title.$request->sex." ";
            }

        $students=$students->orderBy('id','desc')->get();

        $courses=Course::pluck('name','id');

        Excel::create("Registrations $title",function($excel) use($students){
        	 $excel->setTitle('Student Report');
        	 $excel->setCreator('Samuel')
	          ->setCompany('NIELIT');


        	$excel->sheet('Students',function($sheet) use($students){
        		$sheet->fromArray($students);
                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AH1', 'thin');
        	});
        })->export('xlsx');

        return back();
    }

    public function getExportInternal(Request $request){

    		$students=Student_subject::join('students','student_subject.student_id','=','students.id')
    								->join('internals','student_subject.id','=','internals.student_subject_id')
    								->join('subjects','student_subject.subject_id','=','subjects.id')
    								->join('courses', 'students.course_id', '=', 'courses.id')
    								->join('statuses', 'students.status_id', '=', 'statuses.id')
    			->select('students.id','students.name','students.sex',
    			'courses.name as course','students.batch','statuses.name as status','students.doj as yoj',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no',
				'subjects.subject_code','subjects.name as subject','subjects.revised_year','subjects.ia_fullmark',
				'internals.attendance','internals.mark','internals.remarks');

    	/*$students=Student::join('categories', 'students.category_id', '=', 'categories.id')
				            ->join('courses', 'students.course_id', '=', 'courses.id')
				            ->join('communities', 'students.community_id', '=', 'communities.id')
				            ->join('statuses', 'students.status_id', '=', 'statuses.id')
				            ->join('student_subject','students.id','=','student_subject.student_id')
				            ->join('internals','student_subject.id','=','internals.student_subject_id')
				            ->join('subjects','student_subject.subject_id','=','subjects.id')
			->select('students.id','students.name','students.doj as yoj','courses.name as course','students.batch',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','statuses.name as status',
				'subjects.name','subjects.subject_code','subjects.semester','internals.attendance','internals.mark','internals.remarks');
				*/
			

			/*
			->select('students.id','students.name','students.aadhaar','students.eid','students.phone','students.email',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','students.doj as yoj',
				'courses.name as course','students.batch','students.fathers_me','students.mothers_me','students.parents_phone',
				'students.guardian_me','students.guardian_phone','students.dob','students.sex','categories.name as category',
				'communities.name as community','students.per_street','students.per_city','students.per_district','students.per_state',
				'students.per_pin','students.pre_street','students.pre_city','students.pre_district','students.pre_state',
				'students.pre_pin','statuses.name as status','students.status_update_date','students.photo');
			*/

    	//->where('id','>',0);
    	$title="";
        if($request->has('name'))
            {
            	$students=$students->where('name','like','%'.$request->name.'%');
            	$title=$request->name." ";
            }
        if($request->has('course_id'))
        	{
            $students=$students->where('students.course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title.$course->name." ";
        	}
        if($request->has('year'))
            {
            	$students=$students->where('doj','=',$request->year);
            	$title=$title.$request->year." ";
            }
        if($request->has('batch'))
            {
            	$students=$students->where('batch','=',$request->batch);
            	$title=$title.$request->batch." ";
            }

        if($request->has('sex'))
            {
            	$students=$students->where('sex','=',$request->sex);
            	$title=$title.$request->sex." ";
            }

        $students=$students->orderBy('id','desc')->orderBy('subjects.id')->get();

        $courses=Course::pluck('name','id');

        Excel::create("Internals $title",function($excel) use($students){
        	 $excel->setTitle('Student Report');
        	 $excel->setCreator('Samuel')
	          ->setCompany('NIELIT');


        	$excel->sheet('Students',function($sheet) use($students){
        		$sheet->fromArray($students);
                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AH1', 'thin');
        	});
        })->export('xlsx');

        return back();
    }

    public function getExportResult(Request $request){

    		$students=Student_subject::join('students','student_subject.student_id','=','students.id')
    								->join('results','student_subject.id','=','results.student_subject_id')
    								->join('subjects','student_subject.subject_id','=','subjects.id')
    								->join('courses', 'students.course_id', '=', 'courses.id')
    								->join('statuses', 'students.status_id', '=', 'statuses.id')
    			->select('students.id','students.name','students.sex',
    			'courses.name as course','students.batch','statuses.name as status','students.doj as yoj',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no',
				'subjects.subject_code','subjects.name as subject','subjects.revised_year','subjects.ia_fullmark',
				'results.sessional','results.semester','results.total','results.grade','results.grade_points','results.gp_earned','results.remarks');

    	$title="";
        if($request->has('name'))
            {
            	$students=$students->where('students.name','like','%'.$request->name.'%');
            	$title=$request->name." ";
            }
        if($request->has('course_id'))
        	{
            $students=$students->where('students.course_id','=',$request->course_id);
            $course=Course::find($request->course_id);
            $title=$title.$course->name." ";
        	}
        if($request->has('year'))
            {
            	$students=$students->where('doj','=',$request->year);
            	$title=$title.$request->year." ";
            }
        if($request->has('batch'))
            {
            	$students=$students->where('batch','=',$request->batch);
            	$title=$title.$request->batch." ";
            }

        if($request->has('sex'))
            {
            	$students=$students->where('sex','=',$request->sex);
            	$title=$title.$request->sex." ";
            }

            if($request->has('category_id'))
            {
            	$students=$students->where('category_id','=',$request->category_id);
            	$category=Category::find($request->category_id);
            	$title=$title.$category->name." ";
            }

        if($request->has('community_id'))
            {
            	$students=$students->where('community_id','=',$request->community_id);
            	$community=Community::find($request->community_id);
            	$title=$title.$community->name." ";
            }

        if($request->has('status_id'))
            {
            	$students=$students->where('status_id','=',$request->status_id);
            	$status=Status::find($request->status_id);
            	$title=$title.$status->name;
            }

        $students=$students->orderBy('id','desc')->orderBy('subjects.id')->get();

        $courses=Course::pluck('name','id');

        Excel::create("Results $title",function($excel) use($students){
        	 $excel->setTitle('Student Report');
        	 $excel->setCreator('Samuel')
	          ->setCompany('NIELIT');


        	$excel->sheet('Students',function($sheet) use($students){
        		$sheet->fromArray($students);
                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AH1', 'thin');
        	});
        })->export('xlsx');

        return back();
    }
}
