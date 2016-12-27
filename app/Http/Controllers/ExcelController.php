<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Course;
use App\Student;
use App\Category;
use App\Status;
use App\Community;
use App\Subject;
use App\Student_subject;
use Illuminate\Support\Facades\Input;
use Session;
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

    public function getImport(Request $request){
        Excel::load(Input::file('import'),function($reader){

            $rd=$reader->toArray();

            $reader->each(function($sheet){
                Student::firstOrCreate($sheet->toArray());
            });

            foreach($rd as $stu)
                $this->syncNew($stu);
        });
        Session::flash('success','Students Imported Successfully');
        return back();
    }

    public function getImportSubject(Request $request){
        Excel::load(Input::file('import'),function($reader){

            $rd=$reader->toArray();

            $reader->each(function($sheet){
                Subject::firstOrCreate($sheet->toArray());
            });
            
        });
        Session::flash('success','Subjects Imported Successfully');
        return back();
    }

    public function getExportSubjects(Request $request){

        $subjects=Subject::all();

        Excel::create("Subjects",function($excel) use($subjects){
             $excel->setTitle('Subject Report');
             $excel->setCreator('Samuel')
              ->setCompany('NIELIT');


            $excel->sheet('Subjects',function($sheet) use($subjects){
                $sheet->fromArray($subjects);
                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AH1', 'thin');
            });
        })->export('xlsx');

        return back();
    }
    
    public function getExport(Request $request){

    	$students=Student::join('categories', 'students.category_id', '=', 'categories.id')
            ->join('courses', 'students.course_id', '=', 'courses.id')
            ->join('communities', 'students.community_id', '=', 'communities.id')
            ->join('statuses', 'students.status_id', '=', 'statuses.id')
			->select('students.id','students.name','students.aadhaar','students.eid','students.phone','students.email',
				'students.inst_no','students.univ_reg_no','students.exam_roll_no','students.doj as yoj',
				'courses.name as course','students.batch','students.fathers_me','students.mothers_me','students.parents_phone',
				'students.guardian_me','students.guardian_phone','students.dob','students.sex','categories.name as category',
				'communities.name as community','students.per_street','students.per_city','students.per_district','students.per_state',
				'students.per_pin','students.pre_street','students.pre_city','students.pre_district','students.pre_state',
				'students.pre_pin','statuses.name as status','students.status_update_date','students.photo');

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
                $sheet->setOrientation('landscape');

                $sheet->setBorder('A1:AH1', 'thin');
        	});
        })->export('xlsx');

        return back();
    }

    public function syncNew($stu)
    {

        $student=Student::where('name','=',$stu['name'])->whereCourse_id($stu['course_id'])->first();
       // dd($student);
            
        if($student)
        {
            $subjects=Subject::whereCourse_id($student->course_id)->get();
            foreach($subjects as $subject)
            {
                $xx=Student_subject::where('student_id',$student->id)->where('subject_id',$subject->id)->get();
                
                if($xx->count()==0)
                {
                    $student_subject=new Student_subject;
                    $student_subject->student_id=$student->id;
                    $student_subject->subject_id=$subject->id;

                    $student_subject->timestamps=false;
                    $student_subject->save();
                }

            }
            
        }    
        
    }
}
