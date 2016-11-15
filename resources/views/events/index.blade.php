@extends('shared.layout')

@section('Content')
<h1>Events overview</h1>
<p>In this overview you can find all the current events</p>

{!! Form::open(['url' => '/events/addEvent', 'method' => 'POST', 'class' => 'form jumbotron']) !!}
@include('shared.errors')
<h2>Create new event</h2>

<!-- alerting user to fill in the title first -->

<div id="alert-custom" class="alert alert-info alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>Heads up!</strong> Fill in the title first.
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6 form-group">
				{!! Form::label('name', 'Name:') !!}
				{!! Form::text('name', '', ['class' => 'form-control', 'id' => 'toggle-init']) !!}
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6 form-group">
				{!! Form::label('location', 'Location:') !!}
				{!! Form::text('location', '', ['class' => 'form-control', 'id' => 'google-autocomplete' ]) !!}
		</div>
	</div>

	<div id="jq-toggle">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 form-group">
					{!! Form::label('description', 'Description:') !!}
					{!! Form::textarea('description', '', ['class' => 'form-control', 'rows' => '7']) !!}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 form-group">
					{!! Form::label('date_start', 'Start date:') !!}
					{!! Form::date('date_start', '', ['class' => 'form-control', 'min' => '0']) !!}
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 form-group">
					{!! Form::label('time_start', 'Start time:') !!}
					{!! Form::time('time_start', '', ['class' => 'form-control', 'min' => '0']) !!}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6 form-group">
					{!! Form::label('date_end', 'End date:') !!}
					{!! Form::date('date_end', '', ['class' => 'form-control', 'min' => '0']) !!}
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6 form-group">
					{!! Form::label('time_end', 'End time:') !!}
					{!! Form::time('time_end', '', ['class' => 'form-control', 'min' => '0']) !!}
			</div>
		</div>
		<div class="row">
			<div class="col-xs-6 col-sm-6 col-md-6 form-group">
					{!! Form::submit('Add event', ['class' => 'btn btn-primary']) !!}
					<button onclick="customSlideUp()" type="button" class="btn btn-outline-danger">Cancel</button>
			</div>
		</div>
	</div>
</div>

{!! csrf_field() !!}
{!! Form::close() !!}

@forelse ($events as $event)
	<div class="card card-block">
		<h4 class="card-title">{{ $event->name }} - {{ $event->id }}</h4>
		<p class="card-text">{{ $event->description }}</p>
		<p class="card-text">&commat;{{ $event->location }}</p>
		<p class="card-text">Start: {{ $event->datetime_start }}</p>
		<p class="card-text">End: {{ $event->datetime_end }}</p>        
		<a href="./events/{{ $event->id }}" class="card-link">Discover this event</a>
	</div>
@empty
	<p>No events where found...</p>
@endforelse

@endsection


@section('JS')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ-UJgNW-U_SnJvWHweXdT6OlMmnNqtVI&libraries=places"></script>
<script src="{{ @url('/js/event-js.js') }}"></script>
@endsection
