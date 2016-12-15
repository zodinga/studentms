@extends('main')
@section('title','| All Categories')

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>Categories</h1>
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
					</tr>
				</thead>
				<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{$category->id}}</td>
						<td>{{$category->name}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
				{!!Form::open(['route'=>'categories.store','method'=>'POST'])!!}
					<h2>New Category</h2>
					{{Form::label('name')}}
					{{Form::text('name',null,['class'=>'form-control'])}}

					{{Form::submit('Save',['class'=>'btn btn-primary btn-block form-spacing-top'])}}
				{!! Form::close()!!}
			</div>
		</div>
	</div>
@stop