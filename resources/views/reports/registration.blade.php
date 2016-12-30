@extends('main')
@section('title','| Registration Report')

@section('content')
	<div class="row">
		<div class="col-md-3">
			<h2>{{ isset($title)?$title:"" }} Registration Report</h2>
		</div>

		<div class="col-md-6">
		
			{!!Form::open(['route'=>'reports.exportRegistration','method'=>'get'])!!}
		      
		        {{Form::label('name','Student Name:')}}
			    {{Form::text('name',null,['class'=>'form-control','maxlength'=>'50', 'autofocus'=>'autofocus'])}}
				
				{{Form::label('course_id','Course:')}}
			    {{Form::select('course_id', $courses ,null,['class'=>'form-control','placeholder' => 'Pick a course...'])}}

				{{Form::label('year','Year of Joining:')}}
			    {{Form::text('year',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'4'])}}

			    {{Form::label('batch','Batch:')}}
			    {{Form::text('batch',null,['class'=>'form-control','data-parsley-type'=>'number'])}}

			    {{Form::label('sex','Sex:')}}
			    {{Form::select('sex', ['M' => 'Male', 'F' => 'Female'],null,['class'=>'form-control','placeholder' => 'Pick a Gender...'])}}

			    
				<br>
			    <div class="col-md-6 col-md-offset-4">
					<input type="image" src="/img/excel.png" alt="Submit" width="80">
				</div>

				<!--{{Form::submit('Export to Excel',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}-->

		         
			{!!Form::close()!!}



		<hr>
	
	</div>
	</div>
@stop