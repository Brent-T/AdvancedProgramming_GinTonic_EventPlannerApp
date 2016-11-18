@extends('shared.layout')

@section('CSS')
<link rel="stylesheet" href="{{ asset('/css/thumbnail-hover.css') }}" />
@endsection

@section('Content')
<h1>Profile: firstname surname</h1>
<p>Here you can change your profile data</p>
<div class="container">


	<div class="container no-padding no-margin">
		<div class="col-xs-12 col-sm-3 col-md-3 form-group no-padding-left">
			<div class="card card-block">
				<div class="hovereffect">
					<img class="img-responsive" src="{{ asset('/img/defaultprofilepicture.jpg') }}" alt="">
					<div class="overlay">
						<h2>Profile Picture</h2>
						<p>
						{!! Form::open(['url' => '/user/updateprofilepicture', 'method' => 'POST', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
							<a href="#" onclick="triggerFileUpload()">CHANGE</a>
							{!! Form::file('profile_picture', ['class' => 'form-control hide trigger-file-upload', 'onchange' => 'this.form.submit();', 'accept' => '.jpg']) !!}
						{!! csrf_field() !!}
						{!! Form::close() !!}
						</p> 
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-9 col-md-9 form-group no-padding-right">
			<div class="card card-block" id="align-with-picture">
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
		</div>

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

@section('JS')
<script src="{{ @url('/js/profile-js.js') }}"></script>
@endsection
