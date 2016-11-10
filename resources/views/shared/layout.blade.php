<!DOCTYPE html>
<html>
<head>
	<title>EventPlannerApp</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="{{ asset('favicon.png') }}">
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/bower_components/font-awesome/css/font-awesome.min.css') }}">

	@yield('CSS')

</head>
<body>
	<div class="wrapper">
		<nav class="navbar navbar-light bg-faded">
			<a class="navbar-brand" href="{{ url('/') }}">Football Everyday</a>
			<ul class="nav navbar-nav">
				<li class="nav-item @if(!empty($section)) @if($section == 'games') active @endif @endif">
					<a class="nav-link" href="{{ url('/games') }}">Games<!--  <span class="sr-only">(current)</span> --></a>
				</li>
				<li class="nav-item @if(!empty($section)) @if($section == 'teams') active @endif @endif">
					<a class="nav-link" href="{{ url('/teams') }}">Teams</a>
				</li>
				<li class="nav-item @if(!empty($section)) @if($section == 'about') active @endif @endif">
					<a class="nav-link" href="#">About</a>
				</li>
				<li class="nav-item @if(!empty($section)) @if($section == 'contact') active @endif @endif">
					<a class="nav-link" href="#">Contact</a>
				</li>
				@if(Auth::check())			
				<li class="nav-item pull-xs-right">
					<a class="nav-link" href="{{ url('/logout') }}">Logout &lsqb; {{ Auth::user()->name }} &rsqb;</a>
				</li>
				@if(Auth::user()->is('admin'))
				<li class="nav-item pull-xs-right">
					<a class="nav-link @if(!empty($section)) @if($section == 'admin') active @endif @endif" href="{{ url('/admin') }}">Adminpanel</a>
				</li>
				@endif
				@else
				<li class="nav-item pull-xs-right">
					<a class="nav-link" href="{{ url('/login') }}">Login</a>
				</li>
				@endif
			</ul>
		</nav>

		<div class="container">			
			<section>@yield('Content')</section>
		</div>

		<footer>
			<div class="container">
				<p class="pull-xs-right">
					<a href="#">Back to top</a>
				</p>
				<p>&copy; Brent Timmermans | Serverside webscripten 2 | 2015 - 2016</p>
			</div>
		</footer>
	</div>
	
	<!-- Scripts -->
	<script src="{{ @url('/bower_components/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ @url('/bower_components/tether/dist/js/tether.min.js') }}"></script>
	<script src="{{ @url('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	
	@yield('JS')
	
</body>
</html>