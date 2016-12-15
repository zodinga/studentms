@extends('main')
@section('title',"| Edit Subject")
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
<div class="row">
<div class="col-md-8 col-md-offset-2">
	{!!Form::model($subject,['route'=>['subjects.update',$subject->id],'method'=>'put','data-parsley-validate'=>''])!!}
		<h2>Edit Subject</h2>
		{{Form::label('name','Name:')}}
		{{Form::text('name',null,['class'=>'form-control','required'=>'','maxlength'=>'100', 'autofocus'=>'autofocus'])}}

		{{Form::label('subject_code','Subject Code')}}
		{{Form::text('subject_code',null,['class'=>'form-control'])}}

		{{Form::label('course_id','Course:')}}
		{{Form::select('course_id', $courses ,null,['class'=>'form-control','required'=>'','placeholder' => 'Pick a course...'])}}

		{{Form::label('semester','Semester')}}
		{{Form::text('semester',null,['class'=>'form-control','required'=>'','data-parsley-type'=>'digits'])}}

		{{Form::label('credit','Credit:')}}
		{{Form::text('credit',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

		{{Form::label('fullmark','Full Mark:')}}
		{{Form::text('fullmark',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

		{{Form::label('passmark','Passmark:')}}
		{{Form::text('passmark',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

		{{Form::label('ia_fullmark','Internal Fullmark:')}}
		{{Form::text('ia_fullmark',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

		{{Form::label('revised_year','Revised Year:')}}
		{{Form::text('revised_year',null,['class'=>'form-control','required'=>'','data-parsley-minlength'=>'4','data-parsley-maxlength'=>'4','data-parsley-type'=>'digits'])}}

		{{Form::label('old_course')}}
		{{Form::checkbox('old_course',$subject->old_course,isset($subject->old_course))}}

		{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}
	{!! Form::close()!!}
</div>
</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop