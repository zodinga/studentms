@extends('main')
@section('title','| All Subjects')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-9">
			<h1>Subjects</h1>
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Code</td>
						<td>Course</td>
						<td>Sem</td>
						<td>Credit</td>
						<td>FM</td>
						<td>PM</td>
						<td>Int FM</td>
						<td>Rev Yr</td>
						<td>Syllabus</td>
					</tr>
				</thead>
				<tbody>
				@foreach($subjects as $subject)
					<tr>
						<td>{{$subject->id}}</td>
						<td><a href="{{route('subjects.show',$subject->id)}}"> {{$subject->name}}</a></td>
						<td>{{$subject->subject_code}}</td>
						<td>{{$subject->course->name}}</td>
						<td>{{$subject->semester}}</td>
						<td>{{$subject->credit}}</td>
						<td>{{$subject->fullmark}}</td>
						<td>{{$subject->passmark}}</td>
						<td>{{$subject->ia_fullmark}}</td>
						<td>{{$subject->revised_year}}</td>
						<td>{{$subject->old_course?'Old':'New'}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
				{!!Form::open(['route'=>'subjects.store','method'=>'POST','data-parsley-validate'=>''])!!}
					<h2>New Subject</h2>
					{{Form::label('name')}}
					{{Form::text('name',null,['class'=>'form-control','required'=>'','maxlength'=>'100'])}}

					{{Form::label('subject_code')}}
					{{Form::text('subject_code',null,['class'=>'form-control'])}}

					{{Form::label('course_id','Course:')}}
					{{Form::select('course_id', $courses ,null,['class'=>'form-control','required'=>'','placeholder' => 'Pick a course...'])}}

					{{Form::label('semester')}}
					{{Form::text('semester',null,['class'=>'form-control','required'=>'','data-parsley-type'=>'digits'])}}

					{{Form::label('credit')}}
					{{Form::text('credit',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

					{{Form::label('fullmark')}}
					{{Form::text('fullmark',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

					{{Form::label('passmark')}}
					{{Form::text('passmark',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

					{{Form::label('ia_fullmark')}}
					{{Form::text('ia_fullmark',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

					{{Form::label('revised_year')}}
					{{Form::text('revised_year',null,['class'=>'form-control','required'=>'','data-parsley-minlength'=>'4','data-parsley-maxlength'=>'4','data-parsley-type'=>'digits'])}}

					{{Form::label('old_course')}}
					{{Form::checkbox('old_course')}}

					{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}
				{!! Form::close()!!}
			</div>
		</div>
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop