@extends('main')
@section('title','| Edit Student')
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
@stop
@section('content')
<div class="row">
{!! Form::model($student,['route'=>['students.update',$student->id,'data-parsley-validate'=>''],'method'=>'PUT','files'=>true]) !!}
	<div class="col-md-8">
		{{Form::label('photo','Update photo:')}}
		{{Form::file('photo',['accept'=>'image/*' ,'class'=>'form-control'])}}

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

	    {{Form::label('inst_no','Institute Roll Number:')}}
	    {{Form::text('inst_no',null,['class'=>'form-control','maxlength'=>'20'])}}

	    {{Form::label('univ_reg_no','University/Board Reg:')}}
	    {{Form::text('univ_reg_no',null,['class'=>'form-control','maxlength'=>'30'])}}

	    {{Form::label('exam_roll_no','Exam RollNo:')}}
	    {{Form::text('exam_roll_no',null,['class'=>'form-control','maxlength'=>'20'])}}

	    {{Form::label('doj','Year of Joining:')}}
	    {{Form::text('doj',null,['class'=>'form-control','required'=>'','data-parsley-type'=>'digits','maxlength'=>'4'])}}

	    {{Form::label('course_id','Course:')}}
	    {{Form::select('course_id', $courses ,null,['class'=>'form-control','required'=>''])}}

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

	</div>
	<div class="col-md-4">
		<div class="well">
			<img src="{{$student->photo?asset('images/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="45%" width="35%" style="margin-left:100px;">

			<dl class="dl-horizontal">
				<dt>Created At</dt>
				<dd>{{date('M j, Y h:i',strtotime($student->created_at))}}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last Updated</dt>
				<dd>{{date('M j, Y h:i',strtotime($student->updated_at))}}</dd>
			</dl>
			
			<div class="row">
				<div class="col-md-12">
				<a href="{{route('students.editSubject',$student->id)}}" class="btn btn-info btn-block">Edit Subjects</a>
				</div>
			</div>

				
			<hr>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('students.show','Cancel',[$student],['class'=>'btn btn-danger btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{{Form::submit('Save Changes',['class'=>'btn btn-success btn-block'])}}
				</div>

			</div>

			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('students.index','<<All Students',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
				</div>
			</div>
		</div>
	</div>
{!!Form::close()!!}
</div>
@stop
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	{!! Html::script('js/select2.min.js') !!}
	<script type="text/javascript">
		$('.select2-multi').select2();

		$('.select2-multi').select2().val({!! json_encode($student->subjects()->getRelatedIds()) !!}).trigger('change');
	</script>
@stop