<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Student;
use App\Course;
use App\Community;
use App\Category;
use App\Status;
use App\Subject;
use App\Student_subject;
use App\Result;
use Session;
use Image;
use Storage;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /*public function sync()
    {
        $students=Student::all();
        $ss[]=null;
        foreach($students as $student)
        {
            $i=0;
            if($student->course_id<>null)
            {
                $subjects=Subject::where('course_id','=',$student->course_id)->orderby('id')->get();
                foreach($subjects as $subject)
                    if($subject->course_id==$student->course_id)
                        $ss[$i++]=$subject->id;

                $student->subjects()->sync($ss,false);
            }
        }
    }*/

    public function syncNew()
    {
        $students=Student::where('doj','>=',2014)->get();

        foreach($students as $student)
        {
            //finding subject revision year
            $current_rev=Subject::where('course_id',$student->course_id)->groupby('revised_year')->distinct()->orderBy('revised_year', 'desc')->first();
             
             if($current_rev->revised_year > $student->doj)
             {
                echo "old student";

                $nearest_lower=Subject::where('course_id',$student->course_id)->where('revised_year','<=',$student->doj)->distinct()->orderBy('revised_year','desc')->first();
                if(isset($nearest_lower))
                {
                    $subjects=Subject::where('course_id','=',$student->course_id)->where('revised_year',$nearest_lower->revised_year)
                                                                            ->get();   
                    
                }
                else
                {
                    Session::flash('success','Successfully saved!');
                    //redirect to another page
                    return redirect()->route('students.show',$student->id);
                }
             }
            else
            {

                $subjects=Subject::where('course_id','=',$student->course_id)->where('revised_year',$current_rev->revised_year)
                                                                            //->where('old_course','=',false)
                                                                            //->orwhere('old_course',null)
                                                                            ->get();
            }
            //saving subjects lists to student
            foreach($subjects as $subject)
                    {
                        $subject->students()->attach($student);
                    }
            //end of saving subjects
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //For Syncing Subjects to student
        //$this->syncNew();


        //create a variable and store all the students
        $courses=Course::pluck('name','id');
        $students=Student::orderBy('id','desc')->paginate(8);
        //return
        return view('students.index')->withCourses($courses)->withStudents($students);
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

        $courses=Course::pluck('name','id');
        return view('students.index')
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
        $courses=Course::pluck('name','id');
        $categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $statuses=Status::pluck('name','id');
        return view('students.create')
                            ->withCategories($categories)
                            ->withCourses($courses)
                            ->withStatuses($statuses)
                            ->withCommunities($communities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate
        $this->validate($request,array(
            'name'=>'required|max:50',
            'phone'=>'alpha_dash',
            'email'=>'email',
            'photo'=>'sometimes|image',
            'doj'=>'required'
            ));
        //store
        $student=new Student;
        $student->name=$request->name;
        $student->aadhaar=$request->aadhaar;
        $student->eid=$request->eid;
        $student->phone=$request->phone;
        $student->email=$request->email;
        $student->inst_no=$request->inst_no;
        $student->univ_reg_no=$request->univ_reg_no;
        $student->exam_roll_no=$request->exam_roll_no;
        $student->doj=$request->doj;
        $student->course_id=$request->course_id;
        $student->batch=$request->batch;
        $student->fathers_me=$request->fathers_me;
        $student->mothers_me=$request->mothers_me;
        $student->parents_phone=$request->parents_phone;
        $student->guardian_me=$request->guardian_me;
        $student->guardian_phone=$request->guardian_phone;
        $student->dob=$request->dob;
        $student->sex=$request->sex;
        $student->category_id=$request->category_id;
        $student->community_id=$request->community_id;
        $student->per_street=$request->per_street;
        $student->per_city=$request->per_city;
        $student->per_district=$request->per_district;
        $student->per_state=$request->per_state;
        $student->per_pin=$request->per_pin;
        $student->pre_street=$request->pre_street;
        $student->pre_city=$request->pre_city;
        $student->pre_district=$request->pre_district;
        $student->pre_state=$request->pre_state;
        $student->pre_pin=$request->pre_pin;
        $student->status_id=$request->status_id;

        //save photo
        if($request->hasFile('photo')){
            $photo=$request->file('photo');
            $filename=$student->id.'.'. $photo->getClientOriginalExtension();

            $location=public_path('photo/'.$filename);

            Image::make($photo)->resize(413,531)->save($location);

            $student->photo=$filename;
        }
        //end save photo

        $student->save();

        //Test if subjects will be added while creating students 
        if($request->add_subjects==1)
        {
            //finding subject revision year
            $current_rev=Subject::where('course_id',$request->course_id)->groupby('revised_year')->distinct()->orderBy('revised_year', 'desc')->first();
             
             if($current_rev->revised_year > $request->doj)
             {
                echo "old student";

                $nearest_lower=Subject::where('course_id',$request->course_id)->where('revised_year','<=',$request->doj)->distinct()->orderBy('revised_year','desc')->first();
                if(isset($nearest_lower))
                {
                    $subjects=Subject::where('course_id','=',$request->course_id)->where('revised_year',$nearest_lower->revised_year)
                                                                            ->get();   
                    
                }
                else
                {
                    Session::flash('success','Successfully saved!');
                    //redirect to another page
                    return redirect()->route('students.show',$student->id);
                }
             }
            else
            {

                $subjects=Subject::where('course_id','=',$request->course_id)->where('revised_year',$current_rev->revised_year)
                                                                            //->where('old_course','=',false)
                                                                            //->orwhere('old_course',null)
                                                                            ->get();
            }
            //saving subjects lists to student
            foreach($subjects as $subject)
                    {
                        $subject->students()->attach($student);
                    }
            //end of saving subjects
        }
        Session::flash('success','Successfully saved!');

        //redirect to another page
        return redirect()->route('students.show',$student->id);
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

        return view('students.show')->withStudent($student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses=Course::pluck('name','id');
        $categories=Category::pluck('name','id');
        $communities=Community::pluck('name','id');
        $statuses=Status::pluck('name','id');
        //find the post
        $student=Student::find($id);

        $subjects=Subject::where('course_id','=',$student->course_id)->pluck('name','id');

        return view('students.edit')->withStudent($student)
                                    ->withCategories($categories)
                                    ->withCourses($courses)
                                    ->withStatuses($statuses)
                                    ->withCommunities($communities)
                                    ->withSubjects($subjects);
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
        //validate
        $student=Student::find($id);

            $this->validate($request,array(
            'name'=>'required|max:50',
            'phone'=>'alpha_dash',
            'email'=>'email',
            'photo'=>'sometimes|image',
            'doj'=>'required'
            ));
        
        //dd($request->photo);
        //find
        $student=Student::find($id);
        $student->name=$request->input('name');
        $student->aadhaar=$request->input('aadhaar');
        $student->eid=$request->input('eid');
        $student->phone=$request->input('phone');
        $student->email=$request->input('email');

        $student->inst_no=$request->input('inst_no');
        $student->univ_reg_no=$request->input('univ_reg_no');
        $student->exam_roll_no=$request->input('exam_roll_no');
        $student->doj=$request->input('doj');
        $student->course_id=$request->input('course_id');
        $student->batch=$request->input('batch');
        $student->fathers_me=$request->input('fathers_me');
        $student->mothers_me=$request->input('mothers_me');
        $student->parents_phone=$request->input('parents_phone');
        $student->guardian_me=$request->input('guardian_me');
        $student->guardian_phone=$request->input('guardian_phone');
        $student->dob=$request->input('dob');
        $student->sex=$request->input('sex');
        $student->category_id=$request->input('category_id');
        $student->community_id=$request->input('community_id');
        $student->per_street=$request->input('per_street');
        $student->per_city=$request->input('per_city');
        $student->per_district=$request->input('per_district');
        $student->per_state=$request->input('per_state');
        $student->per_pin=$request->input('per_pin');
        $student->pre_street=$request->input('pre_street');
        $student->pre_city=$request->input('pre_city');
        $student->pre_district=$request->input('pre_district');
        $student->pre_state=$request->input('pre_state');
        $student->pre_pin=$request->input('pre_pin');
        $student->status_id=$request->input('status_id');

        //photo
        if ($request->hasFile('photo')) {
            //add new photo
            $photo=$request->file('photo');
            $filename=$student->id.'.'. $photo->getClientOriginalExtension();

            $location=public_path('photo/'.$filename);

            Image::make($photo)->resize(413,531)->save($location);

            $oldfilename=$student->photo;
            //update database
            $student->photo=$filename;
            //delete old photo
            Storage::delete($oldfilename);
        }
        //end photo

        $student->save();

        //updating student-subject relationship

        /*if(isset($request->subjects)){
            $student->subjects()->sync($request->subjects);
        }
        else{
            $student->subjects()->sync(array());
        }
        */
        //end student-subject relationship
        
        $this->resultClean($student->id);

        Session::flash('success','Student updated successfully');

        //return view('students.show')->withStudent($student);
        return redirect()->route('students.show',$student->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $student=Student::find($id);
        $name=$student->name;

        //delete corresponding result NOT JOINED
        $ss=Student_subject::where('student_id',$id)->get();
        foreach($ss as $s)
        {
            $r=Result::where('student_subject_id',$s->id)->first();
            if(is_null($r)==false)
                $r->delete();
        }
        //

        //delete subjects
        $student->subjects()->detach();

        $registrations=$student->registrations;
        foreach($registrations as $registration){
            $registration->delete();    
        }
        
        
        //delete photo
        Storage::delete($student->photo);

        //Delete documents
        foreach($student->documents as $document){

            unlink(public_path('documents\\'.$document->file_name)); 
            unlink(public_path('documents\\thumbs\\'.$document->file_name)); 
        }
        $student->documents()->delete();
        //

        $student->delete();

        Session::flash('success','Student, '.$name.', Successfully deleted!');
        return redirect()->route('students.index');
    }

    public function resultClean($id)
    {
        //not joined
        $student_subject=Student_subject::all();
        $results=Result::all();
        foreach($results as $result)
        {
            $ss=Student_subject::find($result->student_subject_id);
            if(is_null($ss))
                $result->delete();
        }
        //end delete result
    }

    public function editSubject($id){
        $student=Student::find($id);

        $subjects=Subject::where('course_id','=',$student->course_id)->pluck('name','id');

        return view('students.editSubject')->withSubjects($subjects)->withStudent($student);
    }

    public function updateSubject(Request $request,$id){

        $student=Student::find($id);
        if(isset($request->subjects)){
            $student->subjects()->sync($request->subjects);
        }
        else{
            $student->subjects()->sync(array());
        }
        Session::flash('success','Subjects updated Successfully!!');
        return redirect()->back();
    }

    public function addAll($id){

        $student=Student::find($id);
        //finding subject revision year
            $current_rev=Subject::where('course_id',$student->course_id)->groupby('revised_year')->distinct()->orderBy('revised_year', 'desc')->first();
             
             if($current_rev->revised_year > $student->doj)
             {
                echo "old student";

                $nearest_lower=Subject::where('course_id',$student->course_id)->where('revised_year','<=',$student->doj)->distinct()->orderBy('revised_year','desc')->first();
                if(isset($nearest_lower))
                {
                    $subjects=Subject::where('course_id','=',$student->course_id)->where('revised_year',$nearest_lower->revised_year)
                                                                            ->get();   
                    
                }
                else
                {
                    Session::flash('success','Successfully saved!');
                    //redirect to another page
                    return redirect()->route('students.show',$student->id);
                }
             }
            else
            {

                $subjects=Subject::where('course_id','=',$student->course_id)->where('revised_year',$current_rev->revised_year)
                                                                            //->where('old_course','=',false)
                                                                            //->orwhere('old_course',null)
                                                                            ->get();
            }
            //saving subjects lists to student
            foreach($subjects as $subject)
                    {
                        $subject->students()->attach($student);
                    }
            //end of saving subjects
      
        Session::flash('success','Subjects updated Successfully!!');

        return redirect()->back();
    }
}


