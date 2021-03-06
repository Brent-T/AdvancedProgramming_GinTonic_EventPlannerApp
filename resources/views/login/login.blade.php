<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../favicon.ico">

		<title></title>

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('/bower_components/font-awesome/css/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('/css/signin.css') }}" />

		<!-- Custom styles for this template -->
		<!-- <link href="signin.css" rel="stylesheet"> -->
	</head>

	<body>
		<a class="home" href="{{ url('/home') }}"><i class="fa fa-home" aria-hidden="true"></i></a>
		<div class="container">

			{!! Form::open(['url' => url('/user/login'), 'method' => 'POST', 'class' => 'form-signin']) !!}
			@include('shared.errors')
				<h2 class="form-signin-heading">Please sign in</h2>
				{!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autofocus']) !!}
				{!! Form::password('password',['class' => 'form-control', 'placeholder' => 'Password', 'type' => 'password', 'required']) !!}
				 <div class="checkbox">
					<label>
						{!! Form::checkbox('remember me', 'remember-me') !!} Remember me
					</label>
				</div>
				{!! Form::submit('Sign in', ['class' => 'btn-lg btn btn-primary btn-block']) !!}
				<p>no account? Sign up <a class="" href="{{ url('/user/register') }}">here</a></p>
			{!! csrf_field() !!}
			{!! Form::close() !!}

		</div> <!-- /container -->
	</body>
</html>
