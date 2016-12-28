@extends('main')
@section('title','| Login')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			{!! Form::open() !!}
				{{Form::label('email','Email:')}}
				{{Form::email('email',null,['class'=>'form-control','autofocus'])}}

				{{Form::label('password','Password:')}}
				{{Form::password('password',['class'=>'form-control'])}}
				<br>
				{{Form::label('remember','Remember me:')}}
				{{Form::checkbox('remember')}}
				<br>
				{{Form::submit('Login',['class'=>'btn btn-primary btn-block'])}}

				<p><a href="{{url('password/reset')}}">Forgot My Password</a>
			{!! Form::close() !!}					
		</div>
	</div>
	
@stop