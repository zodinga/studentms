@extends('main')

@section('title', '| Register')

@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop

@section('content')
	
<div class="row">
		<div class="col-md-8">
			<div class="well">
			{!! Form::model($user,['route'=>['users.update',$user->id],'method'=>'PUT','data-parsley-validate'=>'']) !!}

				{{ Form::label('name', "Name:") }}
				{{ Form::text('name', null, ['class' => 'form-control','required'=>'', 'autofocus'=>'autofocus']) }}

				{{ Form::label('email', 'Email:') }}
				{{ Form::email('email', null, ['class' => 'form-control','data-parsley-type'=>'email']) }}

				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password', ['class' => 'form-control','required'=>'']) }}

				{{ Form::label('password_confirmation', 'Confirm Password:') }}
				{{ Form::password('password_confirmation', ['class' => 'form-control','required'=>'']) }}
			
				{{ Form::submit('Save', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

			{!! Form::close() !!}
			</div>
		</div>
</div>
@endsection
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop