@extends('main')
@section('title',"| Students")
@section('content')
@if($students->total()==0)
	<h1>No such students</h1>
@else
	<div class="row">
		<div class="col-md-8">
			<h1>{{$stat}} Students:: Total: {{$students->total()}}</h1>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Course</th>
					<th>Batch</th>
					<th>Year</th>
					<th>Created</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@foreach($students as $student)
				<tr>
					<td>{{$student->id}}</td>
					<td>{{$student->name}}</td>
					<td>{{$student->phone}}</td>
					<td>{{$student->course->name}}</td>
					<td>{{$student->batch}}</td>
					<td>{{$student->doj}}</td>
					<td>{{date('M j, Y',strtotime($student->created_at))}}</td>
					<td><a href="{{route('public.single',$student->id)}} " class="btn btn-primary">Read More</a></td>
				</tr>
			@endforeach
			</tbody>
			</table>

			
		</div>
		<hr>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="text-center">
				{!! $students->links() !!}
			</div>
		</div>
	</div>
@endif
@stop