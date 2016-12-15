@if(Session::has('success'))
	<div class="alert alert-success" role="alert">
		<strong>Success:</strong> {{Session::get('success')}}
	</div>
@endif

@if(Session::has('unsuccess'))
	<div class="alert alert-danger" role="alert">
		<strong>Unsuccessful:</strong> {{Session::get('unsuccess')}}
	</div>
@endif

@if($errors->hasany())
	<div class="alert alert-danger" role="alert">
		<strong>Errors:</strong>
		<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
		</ul>
	</div>
@endif