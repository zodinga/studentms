@extends('main')
@section('title','| Create New Student')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-1">
			<h1>Create Student</h1>
			<hr>
			{!! Form::open(['route' => 'students.store','data-parsley-validate'=>'','files'=>true]) !!}
			    {{Form::label('name','Name:')}}
			    {{Form::text('name',null,['class'=>'form-control','required'=>'','maxlength'=>'50', 'autofocus'=>'autofocus'])}}

			    {{Form::label('aadhaar','AAdhaar (xxxx xxxx xxxx):')}}
			    {{Form::text('aadhaar',null,['class'=>'form-control','data-parsley-pattern'=>'^\d{4}\s\d{4}\s\d{4}$'])}}

			    {{Form::label('eid','Eid:')}}
			    {{Form::text('eid',null,['class'=>'form-control','maxlength'=>'10'])}}

			    {{Form::label('phone','Phone:')}}
			    {{Form::text('phone',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'12'])}}

			    {{Form::label('email','Email:')}}
			    {{Form::email('email',null,['class'=>'form-control','data-parsley-type'=>'email'])}}

			    {{Form::label('inst_no','Institute Number:')}}
			    {{Form::text('inst_no',null,['class'=>'form-control','maxlength'=>'20'])}}

			    {{Form::label('univ_reg_no','University/Board Reg:')}}
			    {{Form::text('univ_reg_no',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('exam_roll_no','Exam RollNo:')}}
			    {{Form::text('exam_roll_no',null,['class'=>'form-control','maxlength'=>'20'])}}

			    {{Form::label('doj','Year of Joining:')}}
			    {{Form::text('doj',null,['class'=>'form-control','required'=>'','data-parsley-type'=>'digits','maxlength'=>'4'])}}



			    {{Form::label('course_id','Course:')}}
			    {{Form::select('course_id', $courses ,null,['class'=>'form-control','required'=>'','placeholder' => 'Pick a course...'])}}
				
			    {{Form::label('batch','Batch:')}}
			    {{Form::text('batch',null,['class'=>'form-control','data-parsley-type'=>'number'])}}

			    {{Form::label('fathers_me','Fathers Name:')}}
			    {{Form::text('fathers_me',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('mothers_me','Mothers Name:')}}
			    {{Form::text('mothers_me',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('parents_phone','Parents Phone:')}}
			    {{Form::text('parents_phone',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'12'])}}

			    {{Form::label('guardian_me','Guardian Name:')}}
			    {{Form::text('guardian_me',null,['class'=>'form-control','maxlength'=>'50'])}}

			    {{Form::label('guardian_phone','Guardian Phone:')}}
			    {{Form::text('guardian_phone',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'12'])}}

			    {{Form::label('dob','Date of Birth:')}}
			    {{Form::date('dob',null,['class'=>'form-control'])}}

			    {{Form::label('sex','Sex:')}}
			    {{Form::select('sex', ['M' => 'Male', 'F' => 'Female'],null,['class'=>'form-control'])}}
			    

			    {{Form::label('category_id','Category:')}}
			    {{Form::select('category_id', $categories ,null,['class'=>'form-control'])}}

			    {{Form::label('community_id','Community:')}}
			    {{Form::select('community_id', $communities ,null,['class'=>'form-control'])}}


			    {{Form::label('per_street','Permanent Street:')}}
			    {{Form::text('per_street',null,['class'=>'form-control','maxlength'=>'100'])}}

			    {{Form::label('per_city','Permanent City:')}}
			    {{Form::text('per_city',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('per_district','Permanent District:')}}
			    {{Form::text('per_district',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('per_state','Permanent State:')}}
			    {{Form::text('per_state',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('per_pin','Permanent Pin:')}}
			    {{Form::text('per_pin',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'10'])}}

				{{Form::label('pre_street','Present Street:')}}
			    {{Form::text('pre_street',null,['class'=>'form-control','maxlength'=>'100'])}}

			    {{Form::label('pre_city','Present City:')}}
			    {{Form::text('pre_city',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('pre_district','Present District:')}}
			    {{Form::text('pre_district',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('pre_state','Present State:')}}
			    {{Form::text('pre_state',null,['class'=>'form-control','maxlength'=>'30'])}}

			    {{Form::label('pre_pin','Present Pin:')}}
			    {{Form::text('pre_pin',null,['class'=>'form-control','data-parsley-type'=>'digits','maxlength'=>'10'])}}

			    {{Form::label('status','Status:')}}
			    {{Form::select('status_id',$statuses,null,['class'=>'form-control'])}}

				{{Form::label('photo','Upload photo:')}}
				{{Form::file('photo',['class'=>'form-control'])}}
			
			    {{Form::submit('Create Student',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
			
			
			{!! Form::close() !!}
		</div>
		<div class="col-md-2">
		{!! Form::open(['route' => 'excel.import','method'=>'post','data-parsley-validate'=>'','files'=>true]) !!}
			{{Form::label('import','Select Excel file:')}}
			{{Form::file('import',['accept'=>'.csv' ,'class'=>'form-control'])}}
		
		    {{Form::submit('Import',['class'=>'btn btn-success btn-lg btn-block','style'=>'margin-top:20px'])}}
			
			
		{!! Form::close() !!}
		</div>
	</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}

	<script type="text/javascript">

	$('.select2-multi').select2();

	function jsFunction(){
					var myselect=document.getElementById("course_id");
					var cc=myselect.options[myselect.selectedIndex].value;

				}
	</script>
@stop