<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use App\Student;
use App\Course;
use Session;

class PagesController extends Controller{

	public function getIndex(){
		$courses=Course::pluck('name','id');
		//$students=Student::all();
		//Student Group
		$studentChart=array();
		for($i=2002;$i<2016;$i++){
		//$total=Student::where('doj','=',$i)->count();
		$mca=0;
		$bca=0;
		$diploma=0;
		$shortterm=0;
		$mca=Student::where('doj','=',$i)->where('course_id','=',4)->count();
		$bca=Student::where('doj','=',$i)->where('course_id','=',3)->count();
		$dcse=Student::where('doj','=',$i)->where('course_id',5)->count();
		$dete=Student::where('doj','=',$i)->where('course_id',6)->count();
		$diploma=$dcse+$dete;
		$shortterm=Student::where('doj','=',$i)->where('course_id','<>',3)
												->where('course_id','<>',4)
												->where('course_id','<>',5)
												->where('course_id','<>',6)->count();

		$studentChart[$i]=[$i,$mca,$bca,$diploma,$shortterm];
		}
		//dd($studentChart);

		return view('pages.welcome')->withCourses($courses)->with('studentChart',$studentChart);
									
	}

	public function getAbout(){
	
		return view('pages.about');
	}

	public function getContact(){
		return view('pages.contact');
	}

	public function postContact(Request $request){

		$this->validate($request,array(
			'email'=>'required|email',
			'message'=>'min:10',
			'subject'=>'min:3'
			));

		$data = array(
			'email' => $request->email ,
			'subject'=> $request->subject,
			'bodyMessage'=>$request->message );
		Mail::send('emails.contact',$data,function($message) use ($data){
			$message->from($data['email']);
			$message->to('chleumas@gmail.com');
			$message->subject($data['subject']);
		});

		Session::flash('success','Your email was sent!!');

		return redirect('/');
		//return redirect()->url('/');
	}

	public function getDashboard()
	{
		//Student Percentage
		$total=Student::all()->count();
		$cmca=Student::where('course_id',4)->count();
		$mca=($cmca/$total)*100;
		$cbca=Student::where('course_id',3)->count();
		$bca=($cbca/$total)*100;
		$cdiploma=Student::where('course_id',5)->orwhere('course_id',6)->count();
		$diploma=($cdiploma/$total)*100;
		$longterm=$cmca+$cbca+$cdiploma;
		$shortterm=$total-$longterm;
		$shortterm=($shortterm/$total)*100;

		$percentage=array(round($mca),round($bca),round($diploma),round($shortterm));
		
		//Community
		$christian=Student::where('community_id',1)->count();
		$hindu=Student::where('community_id',2)->count();
		$mushlim=Student::where('community_id',3)->count();
		$buddhist=Student::where('community_id',5)->count();
		$others=Student::where('community_id',4)->count();

		$community=array($christian,$hindu,$mushlim,$buddhist,$others);

		//Category
		$st=Student::where('category_id',1)->count();
		$sc=Student::where('category_id',2)->count();
		$obc=Student::where('category_id',3)->count();
		$gen=Student::where('category_id',4)->count();

		$category=array($st,$sc,$obc,$gen);

		//Status
		$ongoing=Student::where('status_id',1)->count();
		$completed=Student::where('status_id',2)->count();
		$dropout=Student::where('status_id',3)->count();
		$discontinue=Student::where('status_id',4)->count();
		$unknown=Student::where('status_id',null)->count();

		$status=array($ongoing,$completed,$dropout,$discontinue,$unknown);

		return view('pages.dashboard')
						->withCommunity($community)
						->withPercentage($percentage)
						->withCategory($category)
						->withStatus($status);
	}

	public function getStudents($id)
	{
		$students=Student::where('id','>',0);
		$courses=Course::pluck('name','id');

		if($id==1)
			$students->where('course_id',4)->where('status_id',1);
		else if($id==2)
			$students->where('course_id',3)->where('status_id',1);
		else if($id==3)
			$students->where('course_id',6)->orwhere('course_id',5)->where('status_id',1);
		else if($id==4)
			$students->where('course_id','<>',4)
						->where('course_id','<>',3)
						->where('course_id','<>',6)
						->where('course_id','<>',5)
						->where('status_id',1);
		$students=$students->orderBy('course_id')->orderBy('batch','desc')->orderBy('doj','desc')->paginate(8);

		return view('students.index')->withStudents($students)->withCourses($courses)->withTitle("Filtered");
	}
}