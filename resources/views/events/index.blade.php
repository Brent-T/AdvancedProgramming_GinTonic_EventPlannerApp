@extends('shared.layout')

@section('Content')
<h1>Events overview</h1>
<p>In this overview you can find all the current events</p>

{!! Form::open(['url' => '/events/addEvent', 'method' => 'POST', 'class' => 'form']) !!}
@include('shared.errors')
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', '', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', '', ['class' => 'form-control', 'rows' => '7']) !!}
</div>
<div class="form-group">
    {!! Form::label('location', 'Location:') !!}
    {!! Form::text('location', '', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('date_start', 'Start date:') !!}
    {!! Form::date('date_start', '', ['class' => 'form-control', 'min' => '0']) !!}
</div>
<div class="form-group">
    {!! Form::label('time_start', 'Start time:') !!}
    {!! Form::time('time_start', '', ['class' => 'form-control', 'min' => '0']) !!}
</div>
<div class="form-group">
    {!! Form::label('date_end', 'End date:') !!}
    {!! Form::date('date_end', '', ['class' => 'form-control', 'min' => '0']) !!}
</div>
<div class="form-group">
    {!! Form::label('time_end', 'End time:') !!}
    {!! Form::time('time_end', '', ['class' => 'form-control', 'min' => '0']) !!}
</div>
<div class="form-group">
	{!! Form::submit('Add event', ['class' => 'btn btn-primary']) !!}
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
