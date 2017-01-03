<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use App\Student;
use App\Course;
use Session;
use Cache;

class PagesController extends Controller{

	public function getIndex(){
		if(!Session::has('s_courses')){
			Session::put('s_courses',Course::pluck('name','id'));	
		}
		
		//Student Group
		if(!Session::has('s_studentChart')){
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
			Session::put('s_studentChart',$studentChart);
		}

		$courses=Session::get('s_courses');
		$studentChart=Session::get('s_studentChart');

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
		if(!Session::has('s_percentage')){


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
			Session::put('s_percentage',$percentage);
		}
		else
			$percentage=Session::get('s_percentage');
		
		if(!Session::has('s_community')||!Session::has('s_category')||!Session::has('s_status')){

			$community=array();
			$category=array();
			$status=array();
			$tc=0;
			$th=0;
			$tm=0;
			$tb=0;
			$to=0;

			$tst=0;
			$tsc=0;
			$tobc=0;
			$tgen=0;

			$tong=0;
			$tcomp=0;
			$tdrop=0;
			$tdisc=0;
			$tunk=0;

			for($i=2003,$j=0;$i<date("Y");$i++,$j++)
			{
				//Community
				//$students=Student::where('doj',$i);

				$christian=Student::where('doj',$i)->where('community_id',1)->count();
				$hindu=Student::where('doj',$i)->where('community_id',2)->count();
				$mushlim=Student::where('doj',$i)->where('community_id',3)->count();
				$buddhist=Student::where('doj',$i)->where('community_id',5)->count();
				$others=Student::where('doj',$i)->where('community_id',4)->count();

				$tc=$tc+$christian;
				$th=$th+$hindu;
				$tm=$tm+$mushlim;
				$tb=$tb+$buddhist;
				$to=$to+$others;

				$community[$j]=array($i,$christian,$hindu,$mushlim,$buddhist,$others,$tc,$th,$tm,$tb,$to);

				//Category
				$st=Student::where('doj',$i)->where('category_id',1)->count();
				$sc=Student::where('doj',$i)->where('category_id',2)->count();
				$obc=Student::where('doj',$i)->where('category_id',3)->count();
				$gen=Student::where('doj',$i)->where('category_id',4)->count();

				$tst=$tst+$st;
				$tsc=$tsc+$sc;
				$tobc=$tobc+$obc;
				$tgen=$tgen+$gen;

				$category[$j]=array($i,$st,$sc,$obc,$gen,$tst,$tsc,$tobc,$tgen);

				//Status
				$ongoing=Student::where('doj',$i)->where('status_id',1)->count();
				$completed=Student::where('doj',$i)->where('status_id',2)->count();
				$dropout=Student::where('doj',$i)->where('status_id',3)->count();
				$discontinue=Student::where('doj',$i)->where('status_id',4)->count();
				$unknown=Student::where('doj',$i)->where('status_id',null)->count();

				$tong+=$ongoing;
				$tcomp+=$completed;
				$tdrop+=$dropout;
				$tdisc+=$discontinue;
				$tunk+=$unknown;

				$status[$j]=array($i,$ongoing,$completed,$dropout,$discontinue,$unknown,$tong,$tcomp,$tdrop,$tdisc,$tunk);
			}
			Session::put('s_community',$community);
			Session::put('s_category',$category);
			Session::put('s_status',$status);
		}
		else{
			$community=Session::get('s_community');
			$category=Session::get('s_category');
			$status=Session::get('s_status');
		}
		
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