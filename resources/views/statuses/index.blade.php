@extends('main')
@section('title','| All Statuses')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Statuses</h1>
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
					</tr>
				</thead>
				<tbody>
				@foreach($statuses as $status)
					<tr>
						<td>{{$status->id}}</td>
						<td>{{$status->name}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
				{!!Form::open(['route'=>'statuses.store','method'=>'POST'])!!}
					<h2>New Status</h2>
					{{Form::label('name')}}
					{{Form::text('name',null,['class'=>'form-control'])}}

					{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}
				{!! Form::close()!!}
			</div>
		</div>
	</div>
@stop