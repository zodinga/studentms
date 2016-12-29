@extends('main')
@section('title',"| Create Internals")
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
<div class="row">
<div class="col-md-8 col-md-offset-2">
	{!!Form::open(['route'=>['internals.store'],'method'=>'post','data-parsley-validate'=>''])!!}
		<h2>Create Internal :: <u>{{$subject}}</u></h2>

		{{ Form::hidden('student_subject_id', $student_subject_id) }}
		
		{{Form::label('attendance','Attendance:')}}
		{{Form::text('attendance',null,['class'=>'form-control','autofocus'=>'autofocus'])}}

		{{Form::label('mark','Mark:')}}
		{{Form::text('mark',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

		{{Form::label('remarks','Remarks:')}}
		{{Form::text('remarks',null,['class'=>'form-control'])}}

		{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}

	{!! Form::close()!!}
</div>
</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop