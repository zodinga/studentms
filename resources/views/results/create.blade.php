@extends('main')
@section('title',"| Create Result")
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
<div class="row">
<div class="col-md-8 col-md-offset-2">
	{!!Form::open(['route'=>'results.store','data-parsley-validate'=>'','method'=>'POST'])!!}
		<h2>Result Entry:: <u>{{$subject}}</u></h2>

		{{Form::hidden('student_subject_id',$student_subject_id)}}

		{{Form::label('sessional','Sessional (Internal Marks):')}}
		{{Form::text('sessional',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

		{{Form::label('semester','Semester (External Marks):')}}
		{{Form::text('semester',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

		{{Form::label('grade','Grade:')}}
		{{Form::text('grade',null,['class'=>'form-control'])}}

		{{Form::label('grade_points','Grade Points:')}}
		{{Form::text('grade_points',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

		{{Form::label('gp_earned','Grade Points Earned:')}}
		{{Form::text('gp_earned',null,['class'=>'form-control','data-parsley-type'=>'digits'])}}

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