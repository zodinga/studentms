@extends('main')

	
@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
	{!! Html::style('css/select2.min.css') !!}
	<link rel="stylesheet" type="text/css" href="/css/dropzone.min.css">
	<link rel="stylesheet" href="/css/lightbox.css">

	<style type="text/css">
	.document-images img{
		width: 240px;
		height: 160px;
		border: 2px solid green;
		margin-bottom: 10px;
	}
	.document-images ul{
		margin: 0;
		padding: 0;
	}
	.document-images li{
		margin: 0;
		padding: 0;
		list-style: none;
		float: left;
		padding-right: 10px;
	}
</style>
@stop
@section('content')
	<div class="row">
		<div class="col-md-12">
			<a href="{{ URL::previous() }}" class="btn btn-primary">Back</a>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h1>{{$student->name}}</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<form action="{{ url('documents/upload') }}" class="dropzone" id="addDocuments">
				{{csrf_field()}}
				<input type="hidden" name="student_id" value="{{ $student->id }}">
			</form>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="document-images">
				<ul>
					@foreach($student->documents as $document)
						<li>
							<a href="{{url('documents/'.$document->file_name)}}" data-lightbox="roadtrip" data-title="{{$document->doc_name}}">
								<img src="{{ url('documents/thumbs/'.$document->file_name) }}">
							</a>
							<div class="label">
							<a href="/documents/edit/{{$document->id}}">Edit</a>
							</div>
							
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	

@stop

@section('scripts')
	<script src="/js/dropzone.min.js"></script>




	<script src="/js/lightbox.min.js"></script>
	<script src="/js/app.js"></script>
	
@stop