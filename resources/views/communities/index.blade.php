@extends('main')
@section('title','| All Communities')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>Communities</h1>

			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
					</tr>
				</thead>
				<tbody>
				@foreach($communities as $community)
					<tr>
						<td>{{$community->id}}</td>
						<td>{{$community->name}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
				{!!Form::open(['route'=>'communities.store','method'=>'POST'])!!}
					<h2>New Community</h2>
					{{Form::label('name')}}
					{{Form::text('name',null,['class'=>'form-control'])}}

					{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}
				{!! Form::close()!!}
			</div>

		</div>
		
	</div>
	<div class="row">
	<div class="col-md-12 col-md-offset-5" >
			<img src="/img/community.jpg" alt="..." class="img-rounded" height="150" width="150">
		</div>
</div>
@stop