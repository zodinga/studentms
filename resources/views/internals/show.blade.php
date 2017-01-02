@extends('main')
@section('title','| Student Internals')

@section('content')
<div class="row">
	<div class="col-md-10">
	<div class="subjects">
		<h1>Internal Marks</h1>
			<table class="table">
			<thead>
				<tr>
					<td>Code</td>
					<td>Sem</td>
					<td>Subject</td>
					<td>Attendance</td>
					<td>Mark</td>
					<td>Remarks</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
			@foreach($student_subjects as $student_subject)
				<tr>
					<td>{{$student_subject->subject->subject_code}}</td>
					<td>{{$student_subject->subject->semester}}</td>
					<td>{{ substr(strip_tags($student_subject->subject->name), 0, 10) }}{{ strlen(strip_tags($student_subject->subject->name)) > 10 ? "..." : "" }}
					{{substr(strip_tags($student_subject->subject->name), strlen(strip_tags($student_subject->subject->name))-11)}}
					</td>
					<td>{{$student_subject->internal['attendance']}}</td>
					<td>{{$student_subject->internal['mark']}}</td>
					<td>{{$student_subject->internal['remarks']}}</td>
					<td><a href="{{route('internals.edit',$student_subject->id)}}" class="btn btn-info btn-xs">Edit</a></td>
					<td>
					@if(isset($student_subject->internal['id']))
						{!! Form::open(['route'=>['internals.destroy',$student_subject->internal['id']],'method'=>'delete']) !!}
							{{Form::submit('Del',['class'=>'btn btn-danger btn-xs'])}}
						{!! Form::close() !!}
					@endif
					</td>
				</tr>
				</tr>
			@endforeach	
			</tbody>

		</table>
		</div>	
		
	</div>
	<div class="col-md-2">
		<div class="well">
		<div class="row">
			<img src="{{$student->photo?asset('photo/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded " height="50%" width="40%" style="margin-left:50px;">
		</div>
		<hr>
		{{ $student->name }}

			<!--<table class="table">
				<tr>
					<td>Inst Roll No:</td>
					<td>{{$student->inst_no}}</td>
				</tr>
				<tr>
					<td>Univ/Board Reg:</td>
					<td>{{$student->univ_reg_no}}</td>
				</tr>
				<tr>
					<td>Exam Roll:</td>
					<td>{{$student->exam_roll_no}}</td>
				</tr>
				<tr>
					<td>Course:</td>
					<td>{{$student->course->name}}</td>
				</tr>
				<tr>
					<td>Batch:</td>
					<td>{{$student->batch}}</td>
				</tr>
				<tr>
					<td>Year of Join:</td>
					<td>{{$student->doj}}</td>
				</tr>
				<tr>
					<td>Status:</td>
					<td>{{$student->status->name}}</td>
				</tr>
			</table>
			-->

			<hr>

			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('students.index','<<All Students',[],['class'=>'btn btn-primary btn-block btn-h1-spacing'])}}
				</div>
			</div>
		</div>
	</div>
</div>
@stop