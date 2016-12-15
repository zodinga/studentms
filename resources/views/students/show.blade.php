@extends('main')
@section('title','| View Student')

@section('content')
<div class="row">
	<div class="col-md-8">
		<h2>{{ $student->name }}</h2>
		<hr>
		<p class="lead"><b>Status:</b>{{$student->status->name}}</p>
		<p class="lead"><b>Phone:</b>{{$student->phone}}, <b>Email:</b>{{$student->email}}<b>Aadhaar:</b>{{$student->aadhaar}}, <b>Eid:</b>{{$student->eid}}</p>
		<p class="lead"><b>Inst No:</b>{{$student->inst_no}}, <b>Univ/Board Reg:</b>{{$student->univ_reg_no}}, <b>Exam Roll:</b>{{$student->exam_roll_no}}, <b>Year of Join:</b>{{$student->doj}}
		<p class="lead"> <b>Course:</b>{{$student->course->name}}, <b>Batch:</b>{{$student->batch}} <b>Fathers:</b>{{$student->fathers_me}}<p class="lead"> <b>Mothers:</b>{{$student->mothers_me}}, <b>Parents Phone:</b>{{$student->parents_phone}}</p>
		<p class="lead"><b>Guardian:</b>{{$student->guardian_me}}, <b>Guardian Phone:{{$student->guardian_phone}}</p>
		<p class="lead"><b>DOB:</b>{{$student->dob}}, <b>Sex:</b>{{$student->sex}}, <b>Category:</b>{{$student->category->name}}, <b>Community:</b>{{$student->community->name}}</p>
		<p class="lead"><b>Permanent Addr:</b>{{$student->per_street}},{{$student->per_city}},{{$student->per_district}},{{$student->per_state}},PIN-{{$student->per_pin}}</p>
		<p class="lead"><b>Present Addr:</b>{{$student->pre_street}},{{$student->pre_city}},{{$student->pre_district}},{{$student->pre_state}},PIN-{{$student->pre_pin}}</p>
		
		
		<div class="subjects">
			@foreach($student->subjects as $subject)
				<span class="label label-default">{{$subject->name}}</span>
			@endforeach
		</div>
		
	</div>
	<div class="col-md-4">
		<div class="well">
		<img src="{{$student->photo?asset('images/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="45%" width="35%">
				<dl class="dl-horizontal">
				{{ $student->name }}
					<!--<label>Url</label>
					<p><a href="{{ route('public.single',$student->name) }}">{{route('public.single',$student->name)}} </a></p>-->
				</dl>
				<dl class="dl-horizontal">
					<label>Created At</label>
					<p>{{date('M j, Y h:i',strtotime($student->created_at))}}</p>
				</dl>
				<dl class="dl-horizontal">
				<label>Last Updated</label>
				<p>{{date('M j, Y h:i',strtotime($student->updated_at))}}</p>
				</dl>
			<hr>
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('students.edit','Edit',[$student->id],['class'=>'btn btn-primary btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{!! Form::open(['route'=>['students.destroy',$student->id],'method'=>'delete']) !!}
					{{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
				{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('students.index','<<All Students',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
				</div>
			</div>
		</div>
	</div>
</div>
@stop