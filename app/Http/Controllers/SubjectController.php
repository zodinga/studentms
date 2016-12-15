<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Subject;
use App\Course;
use Session;

class SubjectController extends Controller
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
        $courses=Course::pluck('name','id');
        $subjects=Subject::all();

        return view('subjects.index')->withSubjects($subjects)
                                    ->withCourses($courses);
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
        //dd($request->old_course);
        $this->validate($request,array(
            'name'=>'required|max:100',
            'course_id'=>'required|integer',
            'semester'=>'required|integer'
            ));

        $subject=new Subject;

        $subject->name=$request->name;
        $subject->subject_code=$request->subject_code;
        $subject->course_id=$request->course_id;
        $subject->semester=$request->semester;
        $subject->credit=$request->credit;
        $subject->fullmark=$request->fullmark;
        $subject->passmark=$request->passmark;
        $subject->ia_fullmark=$request->ia_fullmark;
        $subject->revised_year=$request->revised_year;
        $subject->old_course=$request->old_course;

        $subject->save();

        Session::flash('success',$subject->name.' was created successfully!!');

        return redirect()->route('subjects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject=Subject::find($id);
        return view('subjects.show')->withSubject($subject);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject=Subject::find($id);
        $courses=Course::pluck('name','id');
        return view('subjects.edit')->withSubject($subject)->withCourses($courses);
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
        $subject=Subject::find($id);

        $this->validate($request,['name'=>'required|max:100']);

        $subject->name=$request->name;
        $subject->subject_code=$request->subject_code;
        $subject->course_id=$request->course_id;
        $subject->semester=$request->semester;
        $subject->credit=$request->credit;
        $subject->fullmark=$request->fullmark;
        $subject->passmark=$request->passmark;
        $subject->ia_fullmark=$request->ia_fullmark;
        $subject->revised_year=$request->revised_year;
        $subject->old_course=$request->old_course;

        $subject->save();

        Session::flash('success','Subject edited successfully');

        return redirect()->route('subjects.show',$subject->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject=Subject::find($id);

        $subject->students()->detach();

        $subject->delete();

        Session::flash('success','Subject was successfully deleted!!');

        return redirect()->route('subjects.index');
    }
}
