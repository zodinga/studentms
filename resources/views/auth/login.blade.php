@extends('main')
@section('title','| Login')
@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<h1>Login</h1>
			{!! Form::open() !!}
				{{Form::label('email','Email:')}}
				{{Form::email('email',null,['class'=>'form-control','autofocus'])}}

				{{Form::label('password','Password:')}}
				{{Form::password('password',['class'=>'form-control'])}}
				<br>
				{{Form::label('remember','Remember me:')}}
				{{Form::checkbox('remember')}}
				<br>
				<a href="{{url('password/reset')}}">Forgot My Password</a>
				<div class="col-md-6 col-md-offset-4">
					<input type="image" src="/img/login_button.png" alt="Submit" width="100">
				</div>
				<!--{{Form::submit('Login',['class'=>'btn btn-primary btn-block'])}}-->
				
			{!! Form::close() !!}					
		</div>
	</div>
	
@stop