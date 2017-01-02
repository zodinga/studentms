@extends('main')
@section('content')
<h1>Edit Document</h1>
<div class="row">
	<div class="col-md-6">
		{!! Form::model($document,['route'=>['documents.update',$document->id],'method'=>'PUT','files'=>true]) !!}
			
			{{Form::hidden('id',$document->id)}}

			{{Form::label('doc_name','Document Name:')}}
	    	{{Form::text('doc_name',null,['class'=>'form-control', 'autofocus'=>'autofocus'])}}
			{{Form::label('file','Update document:')}}
			{{Form::file('file',['accept'=>'image/*' ,'class'=>'form-control'])}}

			{{Form::submit('Save Changes',['class'=>'btn btn-success btn-block'])}}
		{!!Form::close()!!}

		<a href="/documents/destroy/{{$document->id}}" class="btn btn-danger btn-block btn-h1-spacing">Delete</a>
	</div>
</div>

@stop

