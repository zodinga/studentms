@extends('main')
@section('title','| All Students')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>{{ isset($title)?$title:"All " }} Students</h2>
		</div>
		<div class="col-md-9">

			{!!Form::open(['route'=>'students.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Search by Name">
			    	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
		          <input type="text" id="year" name="year" class="form-control form-spacing-top" placeholder="Year" style = "width:60px;">
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Search</button>
			{!!Form::close()!!}

			<a href="{{ route('students.create') }}" class="btn btn-primary btn-lg btn-h1-spacing col-md-offset-2">New Student</a>

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
					<th>Phone</th>	
					<th>Course</th>
					<th>Join</th>
					<th>Batch</th>
					<th>Sem Register</th>
					<th>Updated At</th>
					<th>Actions</th>
				</thead>
				<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{$student->id}}</td>
					<td><img src="{{$student->photo?asset('photo/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="33" width="28"></td>
					<td>{{substr($student->name,0,50)}}{{ strlen($student->name)>50?"..":"" }}</td>
					<td>{{$student->phone}}</td>
					<td>{{$student->course->name}}</td>
					<td>{{$student->doj}}</td>
					<td>{{$student->batch}}</td>
					<td>
					@foreach($student->registrations as $reg)
					{{$reg->semester}},
					@endforeach
					</td>
					<td>{{date_format($student->updated_at,'d/m/Y')}}</td>
					<td>
						<a href="{{route('students.show',$student->id)}}" class="btn btn-info">View</a>
						<a href="{{route('students.edit',$student->id)}}" class="btn btn-warning">Edit</a>
						<a href="{{route('documents.show',$student->id)}}" class="btn btn-primary">{{ $student->documents()->count() }} Docs</a>

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