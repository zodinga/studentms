<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Course;
use App\Student;
use App\Category;
use App\Status;
use App\Community;
use Excel;

class ExcelController extends Controller
{
    //
    public function getIndex(){
    	$courses=Course::pluck('name','id');
    	$categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $statuses=Status::pluck('name','id');

    	return view('reports.index')
    						->withCategories($categories)
                            ->withCourses($courses)
                            ->withStatuses($statuses)
                            ->withCommunities($communities);
    }
    
    public function getExport(Request $request){

    	$students=Student::where('id','>',0);
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

        $students=$students->orderBy('id','desc')->get();

        $courses=Course::pluck('name','id');

        Excel::create("$title",function($excel) use($students){
        	 $excel->setTitle('Student Report');
        	 $excel->setCreator('Samuel')
	          ->setCompany('NIELIT');


        	$excel->sheet('Students',function($sheet) use($students){
        		$sheet->fromArray($students);
        	});
        })->export('xlsx');

        return back();
    }
}
