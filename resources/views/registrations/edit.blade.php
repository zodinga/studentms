@extends('main')
@section('title',"| Edit Registration")
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
<div class="row">
<div class="col-md-8 col-md-offset-2">
	{!!Form::model($registration,['route'=>['registrations.update',$registration->id],'method'=>'put','data-parsley-validate'=>''])!!}
		<h2>Edit Registration :: <u>{{$registration->student->name}}</u></h2>
		
		{{ Form::hidden('student_id', $student_id) }}

			{{Form::label('semester')}}
			{{Form::text('semester',null,['class'=>'form-control','data-parsley-type'=>'digits','required'=>'','data-parsley-max'=>'6','data-parsley-min'=>'1'])}}

			{{Form::label('session')}}
			{{ Form::select('session', [
			   'Jan-Jun' => 'Jan-Jun',
			   'Jul-Dec' => 'Jul-Dec'],null,['class'=>'form-control','required'=>'','placeholder' => 'Pick a Session...']
			) }}

			{{Form::label('year')}}
			{{Form::text('year',null,['class'=>'form-control','data-parsley-type'=>'digits','required'=>'','maxlength'=>'4'])}}

			{{Form::label('receipt_no')}}
			{{Form::text('receipt_no',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

			{{Form::label('remarks')}}
			{{Form::text('remarks',null,['class'=>'form-control'])}}

			{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}

	{!! Form::close()!!}
</div>
</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop