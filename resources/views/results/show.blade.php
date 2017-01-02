@extends('main')
@section('title','| Student Result')

@section('content')
<div class="row">
	<div class="col-md-10">
	<div class="subjects">
		
			<table class="table">
			<thead>
				<tr>
					<td>Code</td>
					<td>Sem</td>
					<td>Subject</td>
					<td>Sess</td>
					<td>Sem</td>
					<td>Total</td>
					<td>Grade</td>
					<td>GP</td>	
					<td>GP Earned</td>
					<td>Remarks</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
			@foreach($student_subjects as $student_subject)
				<tr>
					<td>{{$student_subject->subject->subject_code}}</td>
					<td>{{$student_subject->subject->semester}}</td>
					<td>{{$student_subject->subject->name}}</td>
					<td>{{$student_subject->result['sessional']}}</td>
					<td>{{$student_subject->result['semester']}}</td>
					<td>{{$student_subject->result['total']}}</td>
					<td>{{$student_subject->result['grade']}}</td>
					<td>{{$student_subject->result['grade_points']}}</td>
					<td>{{$student_subject->result['gp_earned']}}</td>
					<td>{{$student_subject->result['remarks']}}</td>
					<td><a href="{{route('results.edit',$student_subject->id)}}" class="btn btn-info btn-xs">Edit</a></td>
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

		<!--	<table class="table">
				<tr>
					<td>Inst Roll:</td>
					<td>{{$student->inst_no}}</td>
				</tr>
				<tr>
					<td>Reg:</td>
					<td>{{$student->univ_reg_no}}</td>
				</tr>
				<tr>
					<td>Exam:</td>
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
					<td>Year:</td>
					<td>{{$student->doj}}</td>
				</tr>
				<tr>
					<td>Status:</td>
					<td>{{$student->status->name}}</td>
				</tr>
			</table>
			-->
			<hr>
			<!--
			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('students.edit','Edit',[$student->id],['class'=>'btn btn-primary btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{!! Form::open(['route'=>['students.destroy',$student->id],'method'=>'delete']) !!}
					{{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
				{!! Form::close() !!}
				</div>
			</div>-->
			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('students.index','<<All Students',[],['class'=>'btn btn-primary btn-block btn-h1-spacing'])}}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<a href="{{ URL::previous() }}" class="btn btn-info btn-block btn-h1-spacing">Back</a>
				</div>

			</div>
		</div>
	</div>
</div>
@stop