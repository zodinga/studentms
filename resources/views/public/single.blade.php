@extends('main')
@section('title',"| $student->name")
@section('content')
	<div class="row">
		<div class="col-md-2">
			<img src="{{$student->photo?asset('images/'.$student->photo):'/img/user.jpg'}}" height="200" width="150">
			
		</div>
		<div class="col-md-10">
			<h1>{{ $student->name }}</h1>
			<b>Phone:</b>{{$student->phone}}, <b>Email:</b>{{$student->email}}
			
			<hr>
			@if($student->aadhaar)
			<b>Aadhaar:</b>{{$student->aadhaar}} 
			@endif
			@if($student->eid)
			, <b>Eid:</b>{{$student->eid}}
			@endif
			
			<hr>
			<b>Inst No:</b>{{$student->inst_no}}, <b>Univ/Board Reg:</b>{{$student->univ_reg_no}}, <b>Exam Roll:</b>{{$student->exam_roll_no}}
			
			<b>, Year of Join:</b>{{$student->doj}}, <b>Course:</b>{{$student->course->name}}, <b>Batch:</b>{{$student->batch}}
		
			<hr>
			@if($student->fathers_me)
			<b>Fathers:</b>{{$student->fathers_me}}
			@endif

			@if($student->mothers_me)
			, <b>Mothers:</b>{{$student->mothers_me}}
			@endif

			@if($student->parents_phone)
			, <b>Parents Phone:</b>{{$student->parents_phone}}
			@endif
			
			@if($student->guardian_me)
			<b>Guardian:</b>{{$student->guardian_me}}
			@endif

			@if($student->guardian_phone)
			, <b>Guardian Phone:{{$student->guardian_phone}}
			@endif
			
			<hr>
			<b>DOB:</b>{{$student->dob}}, <b>Sex:</b>{{$student->sex}}, <b>Category:</b>{{$student->category->name}}, <b>Community:</b>{{$student->community->name}}
			<hr>
			@if($student->per_street or $student->per_city or $student->per_district or $student->per_state or $student->per_pin)
			<b>Permanent Addr:</b>{{$student->per_street}},{{$student->per_city}},{{$student->per_district}},{{$student->per_state}},PIN-{{$student->per_pin}}
			@endif
			
			<hr>
			@if($student->pre_street or $student->pre_city or $student->pre_district or $student->pre_state or $student->pre_pin)
			<b>Present Addr:</b>{{$student->pre_street}},{{$student->pre_city}},{{$student->pre_district}},{{$student->pre_state}},PIN-{{$student->pre_pin}}
			@endif
			
			<b>Status:</b>{{$student->status['name']}}
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="subjects">
		<h1>Results</h1>
		<h3 style="color:#069">If your result is not listed. Report to your coordinator</h3>
			<table class="table table-hover">
			<thead>
				<tr>
					<th>Subject</th>
					<th>Course</th>
					<th>Sess</th>
					<th>Sem</th>
					<th>Total</th>
					<th>Grade</th>
					<th>GP</th>	
					<th>GP Earned</th>
				</tr>
			</thead>
			<tbody>
			@foreach($student_subjects as $student_subject)
				<tr>
					<td>{{$student_subject->subject->name}}</td>
					<td>{{$student_subject->subject->course->name}}</td>
					<td>{{$student_subject->result['sessional']}}</td>
					<td>{{$student_subject->result['semester']}}</td>
					<td>{{$student_subject->result['total']}}</td>
					<td>{{$student_subject->result['grade']}}</td>
					<td>{{$student_subject->result['grade_points']}}</td>
					<td>{{$student_subject->result['gp_earned']}}</td>
				</tr>
				</tr>
			@endforeach	
			</tbody>

		</table>
		</div>	
		</div>
	</div>
@stop