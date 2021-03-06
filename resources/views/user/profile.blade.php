@extends('shared.layout')

@section('CSS')
<link rel="stylesheet" href="{{ asset('/css/thumbnail-hover.css') }}" />
@endsection

@section('Content')
<h1>Profile: {{ Session::get('user')->firstname . ' ' . Session::get('user')->surname}}</h1>
<p>Here you can change your profile data</p>
<div class="container">

	@include('shared.errors')
	<div class="container no-padding no-margin">
		<div class="col-xs-12 col-sm-3 col-md-3 form-group no-padding-left">
			<div class="card card-block">
				<div class="hovereffect">

					@if (file_exists(public_path( '/img/profilepictures/' . Session::get('user')->id . '.jpg' )))
						<img class="img-responsive" src="{{ asset('/img/profilepictures/' . Session::get('user')->id . '.jpg') }}" alt="">
					@elseif (file_exists(public_path( '/img/profilepictures/' . Session::get('user')->id . '.gif' )))
						<img class="img-responsive" src="{{ asset('/img/profilepictures/' . Session::get('user')->id . '.gif') }}" alt="">
					@else
						<img class="img-responsive" src="{{ asset('/img/defaultprofilepicture.jpg') }}" alt="">	
					@endif

					
					<div class="overlay">
						<h2>Profile Picture</h2>
						<p>
						{!! Form::open(array('url' => '/user/profile/updateprofilepicture', 'method' => 'POST', 'class' => 'form', 'files' => 'true')) !!}
							<a href="#" onclick="triggerFileUpload()">CHANGE</a>
							{!! Form::file('profile_picture', ['class' => 'form-control hide trigger-file-upload', 'onchange' => 'this.form.submit();' , 'multiple'=>true, 'accept' => '.jpg, .gif']) !!}
							{!! Form::hidden('userId', Session::get('user')->id) !!}
						{!! csrf_field() !!}
						{!! Form::close() !!}
						</p> 
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-9 col-md-9 form-group no-padding-right">
			<div class="card card-block" style="padding-bottom: 3.5%;">
				{!! Form::open(['url' => '/user/profile/updatename', 'method' => 'POST', 'class' => 'form']) !!}
				<div class="container">
					<div class="row">
							<h4 class="card-title">Name</h4>
							<div class="col-xs-12 col-sm-6 col-md-6 form-group">
									{!! Form::text('firstname', Session::get('user')->firstname, ['class' => 'form-control', 'placeholder' => 'Firstname']) !!}
							</div>
							<div class="col-xs-12 col-sm-6 col-md-6 form-group">
									{!! Form::text('surname', Session::get('user')->surname, ['class' => 'form-control', 'placeholder' => 'Surname']) !!}
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 form-group">
								{!! Form::submit('Update name', ['class' => 'btn btn-outline-primary float-xs-right']) !!}
								{!! Form::hidden('userId', Session::get('user')->id) !!}
						</div>
					</div>
				</div>
				{!! csrf_field() !!}
				{!! Form::close() !!}
			</div>
		</div>

	</div>

	<div class="card card-block">
		{!! Form::open(['url' => '/user/profile/updateemail', 'method' => 'POST', 'class' => 'form']) !!}
		<div class="container">
			<div class="row">
				<h4 class="card-title">Email address</h4>
				<div class="col-xs-12 col-sm-12 col-md-12 form-group">
						{!! Form::email('email', Session::get('user')->email, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 form-group">
					{!! Form::submit('Update email address', ['class' => 'btn btn-outline-primary float-xs-right']) !!}
					{!! Form::hidden('userId', Session::get('user')->id) !!}
				</div>
			</div>
		</div>
		{!! csrf_field() !!}
		{!! Form::close() !!}
	</div>

	<div class="card card-block">
		{!! Form::open(['url' => '/user/profile/updatepassword', 'method' => 'POST', 'class' => 'form']) !!}
		<div class="container">
			<div class="row">
				<h4 class="card-title">Password</h4>
				<div class="form-group row">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Current password</label>
					<div class="col-sm-10">
						{!! Form::password('currentpassword',['class' => 'form-control', 'placeholder' => 'Current password', 'type' => 'password', 'required']) !!}
					</div>
				</div>
				<div class="form-group row input-pw1">
					<label for="inputPassword3" class="col-sm-2 col-form-label">New password</label>
					<div class="col-sm-10">
						{!! Form::password('newpassword',['class' => 'form-control js-check-trigger pw1', 'placeholder' => 'New password', 'type' => 'password', 'required']) !!}
						<div class="form-control-feedback"></div>
					</div>
				</div>
				<div class="form-group row input-pw2">
					<label for="inputPassword3" class="col-sm-2 col-form-label">Confirm password</label>
					<div class="col-sm-10">
						{!! Form::password('confirmpassword',['class' => 'form-control js-check-trigger pw2', 'placeholder' => 'Confirm password', 'type' => 'password', 'required']) !!}
						<div class="form-control-feedback"></div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 form-group">
					{!! Form::submit('Update password', ['class' => 'btn btn-outline-warning float-xs-right']) !!}
					{!! Form::hidden('userId', Session::get('user')->id) !!}
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
