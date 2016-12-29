<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Student;
use App\Subject;
use App\Student_subject;
use App\Internal;
use App\Course;
use Session;

class InternalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students=Student::orderBy('id','desc')->paginate(8);
        $courses=Course::pluck('name','id');
        return view('internals.index')
                    ->withCourses($courses)
                    ->withStudents($students);
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
        return view('internals.index')
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'mark'=>'integer',
            ));

        $internal=new Internal();

        $internal->student_subject_id=$request->student_subject_id;
        $internal->attendance=$request->attendance;
        $internal->mark=$request->mark;
        $internal->remarks=$request->remarks;

        $internal->save();
        Session::flash('success','Internal created successfully!!');

        return redirect()->route('internals.show',$internal->student_subject['student_id']);
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
        return view('internals.show')->withStudent($student)
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
        $internal=Internal::where('student_subject_id','=',$id)->first();
        $stud_subj=Student_subject::find($id);

        $subject=$stud_subj->subject->name;

        if(isset($internal))
            return view('internals.edit')->with('internal',$internal)->withSubject($subject);
        else{
            return view('internals.create')->with('student_subject_id',$id)->withSubject($subject);
        }
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
        dd('update');
        $this->validate($request,array(
            'mark'=>'integer',
            ));

        $internal=Internal::find($id);
        //if(isset($internal)==false)
        //    $internal=new Internal();
        $internal->student_subject_id=$request->student_subject_id;
        $internal->attendance=$request->attendance;
        $internal->mark=$request->mark;
        $internal->remarks=$request->remarks;

        $internal->save();
        Session::flash('success','Internal edited successfully!!');

        return redirect()->route('internals.show',$internal->student_subject['student_id']);
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
        $internal=Internal::find($id);

        if(isset($internal)){
            $internal->delete();
            Session::flash('success','Internal Deleted Successfully');
        }
        else
            Session::flash('unsuccess','Internal not Found');

        return redirect()->back();
    }
}
