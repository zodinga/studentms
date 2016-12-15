<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Student;
use App\Subject;
use App\Student_subject;
use App\Result;
use App\Course;
use Session;

class ResultController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::orderBy('id','desc')->paginate(10);
        $courses=Course::pluck('name','id');
        return view('results.index')
                    ->withCourses($courses)
                    ->withStudents($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function search(Request $request)
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

        //$students->appends(['name'=>$request->name,'course_id'=>$request->course_id,'year'=>$request->year]);
        //$students->appends(Request::except('page'));
        $courses=Course::pluck('name','id');
        return view('results.index')
                    ->withCourses($courses)
                    ->withStudents($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,array(
            'semester'=>'integer',
            'sessional'=>'integer',
            'total'=>'integer',
            'grade'=>'max:5',
            'grade_points'=>'integer',
            'gp_earned'=>'integer',
            ));

        $result=new Result;
        //dd($result->id);
        $result->student_subject_id=$request->student_subject_id;
        $result->semester=$request->semester;
        $result->sessional=$request->sessional;

        $sem=$request->semester?$request->semester:0;
        $sess=$request->sessional?$request->sessional:0;
        $result->total=$sem + $sess;

        $result->grade=$request->grade;
        $result->grade_points=$request->grade_points;
        $result->gp_earned=$request->gp_earned;

        $result->save();

        Session::flash('success','Result edited successfully!!');

        return redirect()->route('results.show',$result->student_subject['student_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student=Student::find($id);
        $student_subjects=Student_subject::where('student_id','=',$student->id)->get();
        return view('results.show')->withStudent($student)
                                    ->with('student_subjects',$student_subjects);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        //$student=Student::find($id);
        //$student_subject=Student_subject::find($id);
        $result=Result::where('student_subject_id','=',$id)->first();
        $stud_subj=Student_subject::find($id);

        $subject=$stud_subj->subject->name;
        if(isset($result))
        return view('results.edit')->with('result',$result)->withSubject($subject);
        else
            return view('results.create')->with('student_subject_id',$id)->withSubject($subject);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,array(
            'semester'=>'integer',
            'sessional'=>'integer',
            'total'=>'integer',
            'grade'=>'max:5',
            'grade_points'=>'integer',
            'gp_earned'=>'integer',
            ));

        $result=Result::find($id);
        //dd($result->id);
        $result->semester=$request->semester;
        $result->sessional=$request->sessional;
        $result->total=$request->semester + $request->sessional;
        $result->grade=$request->grade;
        $result->grade_points=$request->grade_points;
        $result->gp_earned=$request->gp_earned;

        $result->save();
        Session::flash('success','Result edited successfully!!');

        return redirect()->route('results.show',$result->student_subject['student_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
