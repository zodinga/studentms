<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use App\Student;
use App\Registration;

use Session;

class RegistrationController extends Controller
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
        $students=Student::orderBy('id','desc')->paginate(8);
        return view('registrations.index')->withCourses($courses)->withStudents($students);
    }

    public function search(Request $request)
    {
        $students=Student::where('id','>',0);
        if($request->has('name'))
            $students=$students->where('name','like','%'.$request->name.'%');
        if($request->has('course_id'))
            $students=$students->where('course_id','=',$request->course_id);
        if($request->has('year'))
            $students=$students->where('doj','=',$request->year);
        if($request->has('batch'))
            $students=$students->where('batch','=',$request->batch);

        $students=$students->orderBy('id','desc')->paginate(8);

        $courses=Course::pluck('name','id');
        return view('registrations.index')
                    ->withCourses($courses)
                    ->withStudents($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $student=Student::find($id);

        return view('registrations.create')->withStudent($student);
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
            'semester'=>'required',
            'session'=>'required',
            'year'=>'required',
            ));
        
        $registration=new Registration();
        $registration->student_id=$request->student_id;
        $registration->semester=$request->semester;
        $registration->session=$request->session;
        $registration->year=$request->year;
        $registration->receipt_no=$request->receipt_no;
        $registration->remarks=$request->remarks;

        try{
            $registration->save();    
        }
        catch(\Exception $e){
            Session::flash('unsuccess','Error: multiple entry');
        }
        

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $registration=Registration::find($id);
        $student_id=$registration->student->id;
        return view('registrations.edit')->withRegistration($registration)->withStudent_id($student_id);
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
            'semester'=>'required',
            'session'=>'required',
            'year'=>'required',
            ));

        $registration=Registration::find($id);

        $registration->student_id=$request->student_id;
        $registration->semester=$request->semester;
        $registration->session=$request->session;
        $registration->year=$request->year;
        $registration->receipt_no=$request->receipt_no;
        $registration->remarks=$request->remarks;

        try{
            $registration->save();    
            Session::flash('success','Registration edited successfully!!');
        }
        catch(\Exception $e){
            Session::flash('unsuccess','Error!: duplicate entry!!');
        }

        return redirect()->route('registrations.create',$registration->student_id);
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
