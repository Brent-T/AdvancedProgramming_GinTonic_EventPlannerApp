@extends('shared.layout')


@section('CSS')
<link rel="stylesheet" href="{{ asset('/css/calendar-custom.css') }}" />
@endsection


@section('Content')
<div class="jumbotron">
	<div class="container">
		<h1 class="display-3">{{$event->name}}</h1>
		<p class="lead">{{$event->description}}</p>
		<hr class="my-2">
		<p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$event->location}}</p>
		<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i> From {{$event->datetime_start}}</p>
		<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Till {{$event->datetime_end}}</p>
	</div>
</div>
<div class="float-xs-right">
	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#suggestdate"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> suggest date</button>
	<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#suggestlocation"><i class="fa fa-map-marker" aria-hidden="true"></i> suggest location</button>
</div>

<!-- Modal Suggest Date -->
<div class="modal fade" id="suggestdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	{!! Form::open(['url' => '/events/1/suggestdate', 'method' => 'POST', 'class' => 'form']) !!}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Suggest another date</h4>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {!! Form::submit('Suggest date', ['class' => 'btn btn-primary']) !!}
      </div>
  	{!! csrf_field() !!}
	{!! Form::close() !!}
    </div>
  </div>
</div>

<!-- Modal Suggest location -->
<div class="modal fade" id="suggestlocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	{!! Form::open(['url' => '/events/1/suggestlocation', 'method' => 'POST', 'class' => 'form']) !!}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Suggest another location</h4>
      </div>
      <div class="modal-body">
      	<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 form-group">
					{!! Form::label('location', 'Location:') !!}
					{!! Form::text('location', '', ['class' => 'form-control', 'id' => 'google-autocomplete' ]) !!}
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {!! Form::submit('Suggest date', ['class' => 'btn btn-primary']) !!}
      </div>
  	{!! csrf_field() !!}
	{!! Form::close() !!}
    </div>
  </div>
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







@endsection

@section('JS')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ-UJgNW-U_SnJvWHweXdT6OlMmnNqtVI&libraries=places"></script>
<script src="{{ @url('/js/event-js.js') }}"></script>
@endsection
