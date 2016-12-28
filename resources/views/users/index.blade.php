@extends('main')

@section('title', '| Register')

@section('stylesheet')
	{!! Html::style('css/parsley.css') !!}
@stop

@section('content')
	
<div class="row">
		<div class="col-md-9">
			<h1>Users</h1>
			<table class="table">
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Email</td>
						<td>Admin</td>
						<td>Coordinator</td>
						<td>Reception</td>
						<td>Faculty</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
				@foreach($users as $user)
					<tr>
					<form action="{{ route('admin.assign') }}" method="post">
					{{ csrf_field() }}
						<td>{{$user->id}}<input type="hidden" name="id" value="{{ $user->id }}"></td>
						<td>{{$user->name}}</td>
						<td>{{$user->email}}</td>
						<td><input type="checkbox" name="role_admin" {{ $user->hasRole('Admin') ? 'checked' : '' }} ></td>
						<td><input type="checkbox" name="role_coordinator" {{ $user->hasRole('Coordinator') ? 'checked' : '' }}></td>
						<td><input type="checkbox" name="role_reception" {{ $user->hasRole('Reception') ? 'checked' : '' }}></td>
						<td><input type="checkbox" name="role_faculty" {{ $user->hasRole('Faculty') ? 'checked' : '' }}></td>
						
						<td>
							<button type="submit" class="btn btn-warning btn-xs">Assign Role</button>
							<a href="{{route('users.edit',$user->id)}}" class="btn btn-info btn-xs">Edit User</a>
						</td>
					</form>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div><!--end of col-md-8-->
		<div class="col-md-3">
			<div class="well">
			{!! Form::open(['route'=>'users.store','data-parsley-validate'=>'','method'=>'POST']) !!}

				{{ Form::label('name', "Name:") }}
				{{ Form::text('name', null, ['class' => 'form-control','required'=>'']) }}

				{{ Form::label('email', 'Email:') }}
				{{ Form::email('email', null, ['class' => 'form-control','data-parsley-type'=>'email']) }}

				{{ Form::label('password', 'Password:') }}
				{{ Form::password('password', ['class' => 'form-control','required'=>'']) }}

				{{ Form::label('password_confirmation', 'Confirm Password:') }}
				{{ Form::password('password_confirmation', ['class' => 'form-control','required'=>'']) }}
			
				{{ Form::submit('Register', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

			{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
@stop