@extends('shared.layout')

@section('Content')
<h1>Profile: firstname surname</h1>
<p>Here you can change your profile data</p>
<div class="container">

	<div class="card card-block">
		{!! Form::open(['url' => '/user/updatename', 'method' => 'POST', 'class' => 'form']) !!}
		@include('shared.errors')
		<div class="container">
			<div class="row">
				
					<h4 class="card-title">Name</h4>
					<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							{!! Form::text('firstname', '', ['class' => 'form-control', 'placeholder' => 'Firstname']) !!}
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 form-group">
							{!! Form::text('surname', '', ['class' => 'form-control', 'placeholder' => 'Surname']) !!}
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 form-group">
						{!! Form::submit('Update name', ['class' => 'btn btn-outline-primary float-xs-right']) !!}
				</div>
			</div>
		</div>
		{!! csrf_field() !!}
		{!! Form::close() !!}
	</div>

	<div class="card card-block">
		{!! Form::open(['url' => '/user/updateemail', 'method' => 'POST', 'class' => 'form']) !!}
		@include('shared.errors')
		<div class="container">
			<div class="row">
				<h4 class="card-title">Email address</h4>
				<div class="col-xs-12 col-sm-12 col-md-12 form-group">
						{!! Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Email']) !!}
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 form-group">
					{!! Form::submit('Update email address', ['class' => 'btn btn-outline-primary float-xs-right']) !!}
				</div>
			</div>
		</div>
		{!! csrf_field() !!}
		{!! Form::close() !!}
	</div>

	<div class="card card-block">
		{!! Form::open(['url' => '/user/updatepassword', 'method' => 'POST', 'class' => 'form']) !!}
		@include('shared.errors')
		<div class="container">
			<div class="row">
				<h4 class="card-title">Password</h4>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Current password</label>
					<div class="col-sm-10">
						{!! Form::text('currentpassword', '', ['class' => 'form-control', 'placeholder' => 'Current password']) !!}
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">New password</label>
					<div class="col-sm-10">
						{!! Form::text('newpassword', '', ['class' => 'form-control', 'placeholder' => 'New password']) !!}
					</div>
				</div>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Confirm password</label>
					<div class="col-sm-10">
						{!! Form::text('confirmpassword', '', ['class' => 'form-control', 'placeholder' => 'Confirm password']) !!}
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 form-group">
					{!! Form::submit('Update password', ['class' => 'btn btn-outline-warning float-xs-right']) !!}
				</div>
			</div>
		</div>
		{!! csrf_field() !!}
		{!! Form::close() !!}
	</div>
</div>
@endsection
