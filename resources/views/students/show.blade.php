@extends('main')
@section('title','| View Student')

@section('content')
<div class="row">
	<div class="col-md-8">
		<h2>{{ $student->name }}</h2>

		<table class="table table-striped">
			<tbody>
				<tr>
				<th>Status:</th><td>{{$student->status->name}}</td>
				</tr>
				<tr>
				<th>Phone:</th><td>{{$student->phone}}</td>
				<th>Email:</th><td>{{$student->email}}</td>
				</tr>
				<tr>
				<th>Aadhaar:</th><td>{{$student->aadhaar}}</td>
				<th>Eid:</th><td>{{$student->eid}}</td>
				</tr>

				<tr>
				<th>Inst Roll No:</th><td>{{$student->inst_no}}</td>
				<th>Univ/Board Reg:</th><td>{{$student->univ_reg_no}}</td>
				</tr>

				<tr>
					<th>Exam Roll:</th><td>{{$student->exam_roll_no}}</td>
					<th>Year of Join:</th><td>{{$student->doj}}</td>
				</tr>

				<tr>
					<th>Course:</th><td>{{$student->course->name}}</td>
					<th>Batch:</th><td>{{$student->batch}}</td>
				</tr>
				</tr>

					<th>Fathers:</th><td>{{$student->fathers_me}}</td>
					<th>Mothers:</th><td>{{$student->mothers_me}}</td>
				</tr>

				<tr>
					<th>Parents Phone:</th><td>{{$student->parents_phone}}</td>
				</tr>
				<tr>
					<th>Guardian:</th><td>{{$student->guardian_me}}</td>
					<th>Guardian Phone:</th><td>{{$student->guardian_phone}}</td>
				</tr>

				<tr>
					<th>DOB:</th><td>{{$student->dob}}</td>
					<th>Sex:</th><td>{{$student->sex}}</td>
				</tr>

				<tr>
					<th>Category:</th><td>{{$student->category->name}}</td>
					<th>Community:</th><td>{{$student->community->name}}</td>
				</tr>

				<tr>
					<th>Permanent Addr:</th><td>{{$student->per_street}},{{$student->per_city}},{{$student->per_district}},{{$student->per_state}},PIN-{{$student->per_pin}}</td>
				</tr>
				<tr>
					<th>Present Addr:</th><td>{{$student->pre_street}},{{$student->pre_city}},{{$student->pre_district}},{{$student->pre_state}},PIN-{{$student->pre_pin}}</td>
				</tr>

			</tbody>
		</table>


		
		
		<div class="subjects">
		<h3>Subjects Taken:</h3>
			@foreach($student->subjects as $subject)
				@if($subject->semester==1)
				<span class="label label-primary">{{$subject->semester}} | {{$subject->name}}</span>
				@endif
				@if($subject->semester==2)
				<span class="label label-success">{{$subject->semester}} | {{$subject->name}}</span>
				@endif
				@if($subject->semester==3)
				<span class="label label-info">{{$subject->semester}} | {{$subject->name}}</span>
				@endif
				@if($subject->semester==4)
				<span class="label label-warning">{{$subject->semester}} | {{$subject->name}}</span>
				@endif
				@if($subject->semester==5)
				<span class="label label-danger">{{$subject->semester}} | {{$subject->name}}</span>
				@endif
				@if($subject->semester==6)
				<span class="label label-default">{{$subject->semester}} | {{$subject->name}}</span>
				@endif
			@endforeach
		</div>
		
	</div>
	<div class="col-md-4">
		<!--<div class="well">-->
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title">{{$student->name}}</h3>
		  </div>
		  <div class="panel-body">
			<img src="{{$student->photo?asset('photo/'.$student->photo):'/img/user.jpg'}}" alt="..." class="img-rounded" height="35%" width="25%" style="margin-left:100px;">
			<p>
				<dl class="dl-horizontal">
					<label>Created At: </label>
					{{date('M j, Y h:i',strtotime($student->created_at))}}
					<br>
					<label>Last Updated: </label>
					{{date('M j, Y h:i',strtotime($student->updated_at))}}
				</dl>

			<div class="row">
				<div class="col-sm-6">
					{!! Html::linkRoute('students.edit','Edit',[$student->id],['class'=>'btn btn-primary btn-block']) !!}
				</div>
				<div class="col-sm-6">
				{!! Form::open(['route'=>['students.destroy',$student->id],'method'=>'delete']) !!}
					{{Form::submit('Delete',['class'=>'btn btn-danger btn-block'])}}
				{!! Form::close() !!}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				{{Html::linkRoute('students.index','<<All Students',[],['class'=>'btn btn-default btn-block btn-h1-spacing'])}}
				</div>

			</div>
			<hr>
			<dl class="dl-horizontal">
					<label>Registrations</label>
					<div class="table-responsive">
						<table class="table table-condensed table-bordered">
							<thead>
								<tr>
									<th>Date</th>
									<th>Sem</th>
									<th>Session</th>
									<th>Year</th>
									<th>Receipt</th>
									<th>Remark</th>
								</tr>
							</thead>
							<tbody>
								@foreach($student->registrations as $reg)
								<tr>
									<td>{{date_format($reg->updated_at,'d/m/y')}}</td>
									<td>{{$reg->semester}}</td>
									<td>{{$reg->session}}</td>
									<td>{{$reg->year}}</td>
									<td>{{$reg->receipt_no}}</td>
									<td>{{$reg->remarks}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</dl>
			</div>
		</div>
	</div>
</div>
@stop