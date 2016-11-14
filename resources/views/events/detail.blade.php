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
		<!-- <p class="lead"><i class="fa fa-map-marker" aria-hidden="true"></i> Gebroeders De Smetstraat 1, 9000 Ghent, Belgium</p>
		<time datetime="2014-09-20" class="icon">
			<em>Tuesday</em>
			<strong>November</strong>
			<span>15</span>
		</time> -->
	</div>
</div>

<div class="container">
	<!-- <p><i class="fa fa-map-marker" aria-hidden="true"></i> Gebroeders De Smetstraat 1, 9000 Ghent, Belgium</p> -->
	<time datetime="2014-09-20" class="icon">
		<em>Tuesday</em>
		<strong>November</strong>
		<span>15</span>
	</time>
</div>
<p style="margin-top: 2%;">This is the detail page of event number {{ $id }}... Coming soon...</p>






@endsection
