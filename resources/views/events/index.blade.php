@extends('shared.layout')

@section('Content')
<h1>Events overview</h1>
<p>In this overview you can find all the current events</p>

	@forelse ($events as $event)
		<div class="card card-block">
			<h4 class="card-title">{{ $event->name }}</h4>
			<p class="card-text">{{ $event->description }}</p>
			<a href="#" class="card-link">Discover this event</a>
		</div>
	@empty
		<p>No events where found...</p>
	@endforelse

@endsection
