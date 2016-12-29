@extends('main')
@section('title','| Create Registration')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Previous Registrations</h1>
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Student ID</td>
						<td>Semester</td>
						<td>Session</td>
						<td>Year</td>
						<td>Receipt</td>
						<td>Remarks</td>
						<td>Created At</td>
					</tr>
				</thead>
				<tbody>
				@foreach($student->registrations as $reg)
					<tr>
						<td><a href="{{route('registrations.edit',$reg->id)}}">{{$reg->id}}</a></td>
						<td>{{$reg->student_id}}</td>
						<td>{{$reg->semester}}</td>
						<td>{{$reg->session}}</td>
						<td>{{$reg->year}}</td>
						<td>{{$reg->receipt_no}}</td>
						<td>{{$reg->remarks}}</td>
						<td>{{date_format($reg->created_at,'d/m/Y')}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->


		<div class="col-md-3">
			<div class="well">
				<h2>New Registration</h2>
				{!!Form::open(['route'=>'registrations.store','method'=>'POST','data-parsley-validate'=>''])!!}
					
					{{ Form::hidden('student_id', $student->id) }}

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
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop