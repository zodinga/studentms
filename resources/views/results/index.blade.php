@extends('main')
@section('title','| All Students')

@section('content')
	<div class="row">
		<div class="col-md-4">
			<h1>All Students</h1>
		</div>
		<div class="col-md-8">
			{!!Form::open(['route'=>'results.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Search by Name">
			    	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
		          <input type="text" id="year" name="year" class="form-control form-spacing-top" placeholder="Year">
		        </div>
		        <button type="submit" class="btn btn-default form-spacing-top">Submit</button>
			{!!Form::close()!!}

		</div>
		<hr>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Photo</th>
					<th>Name</th>
					<th>Course</th>	
					<th>Batch</th>
					<th>Year</th>
					<th>Action</th>
				</thead>
				<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{$student->id}}</td>
					<td><img src="{{$student->photo?asset('images/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="33" width="28"></td>
					<td>{{substr($student->name,0,50)}}{{ strlen($student->name)>50?"..":"" }}</td>
					<td>{{$student->course->name}}</td>
					<td>{{$student->batch}}</td>
					<td>{{$student->doj}}</td>
					<td><a href="{{route('students.show',$student->id)}}" class="btn btn-default">View</a><a href="{{route('students.edit',$student->id)}}" class="btn btn-default">Edit</a><a href="{{route('results.show',$student->id)}}" class="btn btn-default">Result</a>
					</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $students->appends(Request::except('page'))->links() !!}
			</div>
		</div>
	</div>
@stop