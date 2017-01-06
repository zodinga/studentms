@extends('main')
@section('title','| Students Internals')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>Students Internals</h2>
		</div>
		<div class="col-md-9">
			{!!Form::open(['route'=>'internals.search','method'=>'get','class'=>'navbar-form navbar-left'])!!}
		        <div class="form-group">
		          <input type="text" id="name" name="name" class="form-control form-spacing-top" placeholder="Search by Name">
			    	{{Form::select('course_id', $courses ,null,['class'=>'form-control form-spacing-top','placeholder' => 'Pick a course...'])}}
		          <input type="text" id="year" name="year" class="form-control form-spacing-top" placeholder="Year" style = "width:60px;">
		        </div>
		        <button type="submit" class="btn btn-success form-spacing-top">Submit</button>
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
					<th>Subjects</th>
					<th>Action</th>
				</thead>
				<tbody>
				@foreach($students as $student)
				<tr>
					<td>{{$student->id}}</td>
					<td><img src="{{$student->photo?asset('photo/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="33" width="28"></td>
					<td>{{substr($student->name,0,50)}}{{ strlen($student->name)>50?"..":"" }}</td>
					<td>{{$student->course->name}}</td>
					<td>{{$student->batch}}</td>
					<td>{{$student->doj}}</td>
					<td>{{$student->subjects()->count()}}</td>
					<td>
						<a href="{{route('internals.show',$student->id)}}" class="btn btn-info btn-sm">Internal</a>
						<a href="{{route('students.show',$student->id)}}" class="btn btn-primary btn-sm">View</a>
					@if($student->subjects()->count()==0)
						<!-- Delete Modal -->
                      <div class="modal fade" id="Add<?php echo $student->id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h2>Confirmation</h2>
                            </div>
                            <div class="modal-body">
                                Are you sure to Add All Subjects to ... Mr {{$student->name}}?
                            </div>
                            <div class="modal-footer">
                            	
	                            <div class="col-md-4 ">
	                      			<a href="{{route('students.addAll',$student->id)}}" class="btn btn-danger">Automatic Add All Subjects</a>
						  		</div>
						  		<div class="col-md-4 col-md-offset-4">
                              		<button type="button" class="btn btn-warning btn-block" data-dismiss="modal">No</button>
                              	</div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="#Add{{$student->id}}"  role="button" class="btn btn-danger" data-toggle="modal" title="Delete Student">Add All</a>
                      <!-- End Delete Modal -->
                    @endif
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