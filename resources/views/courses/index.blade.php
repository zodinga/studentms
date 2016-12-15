@extends('main')
@section('title','| All Courses')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Courses</h1>
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Full Form</td>
						<td>Type</td>
						<td>Semesters</td>
						<td>Duration(months)</td>
					</tr>
				</thead>
				<tbody>
				@foreach($courses as $course)
					<tr>
						<td>{{$course->id}}</td>
						<td>{{$course->name}}</td>
						<td>{{$course->full_form}}</td>
						<td>{{$course->type}}</td>
						<td>{{$course->semester}}</td>
						<td>{{$course->duration}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-4">
			<div class="well">
				{!!Form::open(['route'=>'courses.store','method'=>'POST','data-parsley-validate'=>''])!!}
					<h2>New Course</h2>
					{{Form::label('name')}}
					{{Form::text('name',null,['class'=>'form-control','required'=>'','maxlength'=>'100'])}}

					{{Form::label('Full Form')}}
					{{Form::text('full_form',null,['class'=>'form-control'])}}

					{{Form::label('Type')}}
					{{Form::select('type', ['Long Term' => 'Long Term', 'Short Term' => 'Short Term'],null,['class'=>'form-control'])}}
					<!--{{Form::text('type',null,['class'=>'form-control'])}}-->

					{{Form::label('Semester')}}
					{{Form::text('semester',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

					{{Form::label('Duration')}}
					{{Form::text('duration',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

					{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}
				{!! Form::close()!!}
			</div>
		</div>
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop