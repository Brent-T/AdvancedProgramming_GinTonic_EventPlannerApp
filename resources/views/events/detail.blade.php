@extends('shared.layout')


@section('CSS')
<link rel="stylesheet" href="{{ asset('/css/calendar-custom.css') }}" />
@endsection


@section('Content')
<div class="jumbotron">
	<div class="container">
		<h1 class="display-3">Test Event</h1>
		<p class="lead">Here will be the most amazing and well thought off description evah!</p>
		<hr class="my-2">
		<p><i class="fa fa-map-marker" aria-hidden="true"></i> Gebroeders De Smetstraat 1, 9000 Ghent, Belgium</p>
		<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i> From ...</p>
		<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Till ...</p>
		<!-- <p class="lead"><i class="fa fa-map-marker" aria-hidden="true"></i> Gebroeders De Smetstraat 1, 9000 Ghent, Belgium</p>
		<time datetime="2014-09-20" class="icon">
			<em>Tuesday</em>
			<strong>November</strong>
			<span>15</span>
		</time> -->

	</div>
</div>
<div class="float-xs-right">
	<button type="button" class="btn btn-outline-primary"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> suggest date</button>
	<button type="button" class="btn btn-outline-primary"><i class="fa fa-map-marker" aria-hidden="true"></i> suggest location</button>
</div>

<div class="container">

	<h2>Invitees</h2>
	<ul>
		<li>Brent Timmermans</li>
		<li>Brent Timmermans</li>
		<li>Brent Timmermans</li>
		<li>Brent Timmermans</li>
	</ul>

	<h2>Requirements</h2>


	<!-- <p><i class="fa fa-map-marker" aria-hidden="true"></i> Gebroeders De Smetstraat 1, 9000 Ghent, Belgium</p> -->
	<time datetime="2014-09-20" class="icon">
		<em>Tuesday</em>
		<strong>November</strong>
		<span>15</span>
	</time>
</div>
<p style="margin-top: 2%;">This is the detail page of event number {{ $id }}... Coming soon...</p>






@endsection
