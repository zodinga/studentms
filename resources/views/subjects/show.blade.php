@extends('main')
@section('title',"| $subject->name")
@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1> {{$subject->name}} ({{$subject->subject_code}})<small>/ {{$subject->students()->count()}} students take this subject</small></h1>
		</div>
		<div class="col-md-2">
			<a href="{{route('subjects.index')}}" class="btn btn-warning btn-block" style="margin-top:20px">Back to Subjects</a>
		</div>
		<div class="col-md-1">
			
			<a href="{{route('subjects.edit',$subject->id)}}" class="btn btn-primary btn-block" style="margin-top:20px">Edit</a>
		</div>
		<div class="col-md-1">

			{!! Form::open(['route'=>['subjects.destroy',$subject->id],'method'=>'DELETE'])!!}
			{{ Form::submit('Delete',['class'=>'btn btn-danger btn-block','style'=>'margin-top:20px;'])}}
			{!!Form::close()!!}
		</div>


	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Course</th>
						<th>Batch</th>
						<th>Subjects</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				@foreach($subject->students as $student)
					<tr>
						<td>{{$student->id}}</td>
						<td>{{$student->name}}</td>
						<td>{{$student->course->name}}</td>
						<td>{{$student->batch}}</td>
						<td>@foreach($student->subjects as $subject)
							<span class="label label-default">{{$subject->subject_code}}</span>
							@endforeach
							</td>
						<td><a href="{{route('students.show',$student->id)}}" class="btn btn-default btn-xs">View</a></td>

					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

@stop