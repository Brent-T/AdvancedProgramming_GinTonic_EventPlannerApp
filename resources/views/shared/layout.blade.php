<!DOCTYPE html>
<html>
<head>
	<title>EventPlannerApp</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="{{ asset('favicon.png') }}">
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/bower_components/font-awesome/css/font-awesome.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('/css/bootstrap-custom-theme.css') }}" />
	<link rel="stylesheet" href="{{ asset('/css/bottom_footer.css') }}" />

	@yield('CSS')

</head>
<body>
	<div class="wrapper">
		<nav class="navbar navbar-light">

			<button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"></button>

			<div class="collapse navbar-toggleable-md" id="navbarResponsive">

				<a class="navbar-brand" href="{{ url('/home') }}">Event Planner</a>

				<ul class="nav navbar-nav">
					<li class="nav-item custom-nav-link">
						<a class="nav-link" href="{{ url('/home') }}">Home </a>
					</li>
					@if(Session::has('user'))
					<li class="nav-item custom-nav-link">
						<a class="nav-link" href="{{ url('/events') }}">Events </a>
					</li>
					@endif
				</ul>
				<ul class="nav navbar-nav float-xs-right">
				@if(Session::has('user'))
					<li class="nav-item">
						<a href="{{ url('/user/profile') }}" class="nav-link custom-nav-link"><i class="fa fa-user" aria-hidden="true"></i> Profile &lsqb; {{ Session::get('user')->firstname }} &rsqb;</a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/user/logout') }}" class="nav-link custom-nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
					</li>
				@else
					<li class="nav-item">
						<a href="{{ url('/user/register') }}" class="nav-link custom-nav-link"><i class="fa fa-user" aria-hidden="true"></i> Register</a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/user/login') }}" class="nav-link custom-nav-link"><i class="fa fa-sign-out" aria-hidden="true"></i> Login</a>
					</li>
				@endif
				</ul>
			</div>
		</nav>

		<div class="container content">         
			<section>@yield('Content')</section>
		</div>


		<footer class="text-muted custom-footer">
			<div class="container">
			<p class="float-xs-right">
				<a href="#">Back to top</a>
			</p>
			<p>&copy; Team Gin Tonic | Advanced Programming | 2016 - 2017</p>
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