@extends('main')
@section('title','| Student Registration')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>Registration</h2>
		</div>
		<div class="col-md-9">
			{!!Form::open(['route'=>'registrations.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Search by Name">
			    	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
		          <input type="text" id="year" name="year" class="form-control form-spacing-top" placeholder="Year" style = "width:60px;">
		          <input type="text" id="batch" name="batch" class="form-control form-spacing-top" placeholder="Batch" style = "width:65px;">
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Search</button>
			{!!Form::close()!!}
		</div><!--end of col-md-8-->
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Photo</th>
					<th>Name</th>
					<th>Course</th>
					<th>Join</th>
					<th>Batch</th>
					<th>Actions</th>
				</thead>
				<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{$student->id}}</td>
					<td><img src="{{$student->photo?asset('images/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="33" width="28"></td>
					<td>{{substr($student->name,0,50)}}{{ strlen($student->name)>50?"..":"" }}</td>
					<td>{{$student->course->name}}</td>
					<td>{{$student->doj}}</td>
					<td>{{$student->batch}}</td>
					<td>
						<a href="{{route('registrations.create',$student->id)}}" class="btn btn-warning">Register</a>
						<a href="{{route('students.show',$student->id)}}" class="btn btn-info">View</a>
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
