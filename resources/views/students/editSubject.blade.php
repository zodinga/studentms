@extends('main')
@section('title','| Edit Subject')
@section('stylesheet')
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')

<div class="row">
	<div class="col-md-6">
	<a href="{{route('students.edit',$student->id)}}" class="btn btn-warning btn-block btn-h1-spacing">Back to Edit</a>
	</div>
	
	<div class="col-md-6">
	{{Html::linkRoute('students.index','Back to All Students',[],['class'=>'btn btn-primary btn-block btn-h1-spacing'])}}
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">

	{!! Form::model($student,['route'=>['students.updateSubject',$student->id],'method'=>'PUT']) !!}
		
		{{Form::select('subjects[]',$subjects,null,['class'=>'select2-multi form-control','multiple'=>'multiple'])}}
		
		{{Form::submit('Save Changes',['class'=>'btn btn-success btn-block btn-h1-spacing'])}}

	{!!Form::close()!!}
	</div>
</div>

@stop
@section('scripts')
	{!! Html::script('js/select2.min.js') !!}
	<script type="text/javascript">
		$('.select2-multi').select2();

		$('.select2-multi').select2().val({!! json_encode($student->subjects()->getRelatedIds()) !!}).trigger('change');
	</script>
@stop