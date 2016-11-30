@extends('shared.layout')


@section('CSS')
<link rel="stylesheet" href="{{ asset('/css/calendar-custom.css') }}" />
<link rel="stylesheet" href="{{ asset('/css/event-detail.css') }}" />
@endsection


@section('Content')
<div class="jumbotron row">
	<div class="container">
		<h1 class="display-3">{{$event->name}}</h1>
		<p class="lead">{{$event->description}}</p>
		<hr class="my-2">
		<p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$event->location}}</p>
		<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i> From {{$event->datetime_start}}</p>
		<p><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Till {{$event->datetime_end}}</p>
		<div id="accordion" role="tablist" aria-multiselectable="true">
			<!-- Suggested Locations -->
			<div class="card">
				<div class="card-header" role="tab" id="headingOne">
					<h5 class="mb-0">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<i class="fa fa-map-marker" aria-hidden="true"></i> Suggested Locations <span class="tag tag-default tag-pill float-xs-right">2</span>
						</a>
					</h5>
				</div>
				<div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
					<div class="card-block">
						<table class="table table-locations">
							<tbody>
								<tr>
									<td>Odisee Technologiecampus Gent</td>
									<td><progress class="progress progress-danger" value="1" max="10"></progress></td>
									<td class="text-xs-center">
										<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
									</td>
								</tr>
								<tr>
									<td>US Mexican Border</td>
									<td><progress class="progress progress-success" value="6" max="10"></progress></td>
									<td class="text-xs-center">
										<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Suggested dates -->
			<div class="card">
				<div class="card-header" role="tab" id="headingOne">
					<h5 class="mb-0">
						<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
							<i class="fa fa-calendar-check-o" aria-hidden="true"></i> Suggested dates<span class="tag tag-default tag-pill float-xs-right">2</span>
						</a>
					</h5>
				</div>
				<div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingOne">
					<div class="card-block">
						<table class="table table-dates">
							<tbody>
								<tr>
									<td><i class="fa fa-clock-o" aria-hidden="true"></i> {{$event->datetime_start}} - {{$event->datetime_end}}</td>
									<td><progress class="progress progress-success" value="7" max="10"></progress></td>
									<td class="text-xs-center">
										<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
									</td>
								</tr>
								<tr>
									<td><i class="fa fa-clock-o" aria-hidden="true"></i> {{$event->datetime_start}} - {{$event->datetime_end}}</td>
									<td><progress class="progress progress-success" value="4" max="10"></progress></td>
									<td class="text-xs-center">
										<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
										<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
@include('shared.errors')
</div>

<div class="row">
	<div class="float-xs-right custom-button-group-event-detail">
		<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#addpeople" ><i class="fa fa-user-plus" aria-hidden="true"></i> Invite people to join this event</button>
		<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#suggestdate"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Suggest date</button>
		<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#suggestlocation"><i class="fa fa-map-marker" aria-hidden="true"></i> Suggest location</button>
	</div>
</div>
<!-- Modal Suggest Date -->
<div class="modal fade" id="suggestdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		{!! Form::open(['url' => '/events/' . $event->id . '/suggestdate', 'method' => 'POST', 'class' => 'form']) !!}
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
				{!! Form::hidden('event_id', $event->id) !!}
			</div>
			{!! csrf_field() !!}
			{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Modal Suggest location -->
<div class="modal fade" id="suggestlocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		{!! Form::open(['url' => '/events/' . $event->id . '/suggestlocation', 'method' => 'POST', 'class' => 'form']) !!}
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
				{!! Form::hidden('event_id', $event->id) !!}
			</div>
		{!! csrf_field() !!}
		{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Modal Suggest location -->
<div class="modal fade" id="addpeople" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		{!! Form::open(['url' => '/events/' . $event->id . '/addpeople', 'method' => 'POST', 'class' => 'form']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Invite people</h4>
			</div>
			<div class="modal-body">
				<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 form-group">
					{!! Form::label('invite', 'Invite:') !!}
					{!! Form::text('location', '', ['class' => 'form-control', 'id' => 'suggest', ]) !!}
					<!-- 'data-provide' => 'typeahead' -->
			</div>
		</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				{!! Form::submit('Send Invite', ['class' => 'btn btn-primary']) !!}
				{!! Form::hidden('event_id', $event->id) !!}
			</div>
		{!! csrf_field() !!}
		{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Invitees and Requirements -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 ">
		<h3>Invitees</h3>
		<table class="table table-invitees">
			<tbody>
				<tr>
					<td><img class="invited-thumbnail" src="{{ asset('/img/defaultprofilepicture.jpg') }}"></td>
					<td class="text-xs-left vcenter-name">Brent Timmermans</td>
					<td class="text-xs-left vcenter-name"><a href="" class="btn btn-outline-primary btn-sm">info</a></td>
				</tr>
				<tr>
					<td><img class="invited-thumbnail" src="{{ asset('/img/defaultprofilepicture.jpg') }}"></td>
					<td class="text-xs-left vcenter-name">Alessio De Groote</td>
					<td class="text-xs-left vcenter-name"><a href="" class="btn btn-outline-primary btn-sm">info</a></td>
				</tr>
				<tr>
					<td><img class="invited-thumbnail" src="{{ asset('/img/defaultprofilepicture.jpg') }}"></td>
					<td class="text-xs-left vcenter-name">Dieter Deschuiteneer</td>
					<td class="text-xs-left vcenter-name"><a href="" class="btn btn-outline-primary btn-sm">info</a></td>
				</tr>
				<tr>
					<td><img class="invited-thumbnail" src="{{ asset('/img/defaultprofilepicture.jpg') }}"></td>
					<td class="text-xs-left vcenter-name">Jonas Reyniers</td>
					<td class="text-xs-left vcenter-name"><a href="" class="btn btn-outline-primary btn-sm">info</a></td>
				</tr>
				<tr>
					<td><img class="invited-thumbnail" src="{{ asset('/img/defaultprofilepicture.jpg') }}"></td>
					<td class="text-xs-left vcenter-name">Timothy Dewolf</td>
					<td class="text-xs-left vcenter-name"><a href="" class="btn btn-outline-primary btn-sm">info</a></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8">
		<h3>Requirements</h3>
		<table class="table table-requirements">
			<tbody>
				<tr>
					<td>Gender Equal food</td>
					<td>dafuq is this even?</td>
				</tr>
				<tr>
					<td>Apache Helicopters</td>
					<td>CHOP CHOP MOFO'S</td>
				</tr>
				<tr>
					<td>Trebuchets</td>
					<td>90 kg flaming projectiles that can be launched at 300 meter distance and accuratly hit target</td>
				</tr>
				<tr>
					<td>Crusaders</td>
					<td>Deus Vult</td>
				</tr>
				<tr>
					<td>Dank Memes</td>
					<td>Thomas the Dank engine</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<!-- Suggestions -->
<div class=row>
	<div class="col-xs-12 col-sm-12 col-md-12">
		<h3>Suggestions</h3>
		<table class="table table-suggestions">
			<tbody>
				<tr>
					<td>Gender Equal food</td>
					<td><button type="button" class="btn btn-outline-primary btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-content="dafuq is this even?">info</button></td>
					<td><progress class="progress progress-success" value="5" max="10"></progress></td>
					<td class="text-xs-center">
						<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
					</td>
				</tr>
				<tr>
					<td>Apache Helicopters</td>
					<td><button type="button" class="btn btn-outline-primary btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-content="CHOP CHOP MOFO'S">info</button></td>
					<td><progress class="progress progress-success" value="7" max="10"></progress></td>
					<td class="text-xs-center">
						<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
					</td>
				</tr>
				<tr>
					<td>Trebuchets</td>
					<td><button type="button" class="btn btn-outline-primary btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-content="90 kg flaming projectiles that can be launched at 300 meter distance and accuratly hit target">info</button></td>
					<td><progress class="progress progress-success" value="1" max="10"></progress></td>
					<td class="text-xs-center">
						<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
					</td>
				</tr>
				<tr>
					<td>Crusaders</td>
					<td><button type="button" class="btn btn-outline-primary btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Deus Vult">info</button></td>
					<td><progress class="progress progress-success" value="3" max="10"></progress></td>
					<td class="text-xs-center">
						<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
					</td>
				</tr>
				<tr>
					<td>Dank Memes</td>
					<td><button type="button" class="btn btn-outline-primary btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Thomas the Dank engine">info</button></td>
					<td><progress class="progress progress-success" value="9" max="10"></progress></td>
					<td class="text-xs-center">
						<button type="button" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
						<button type="button" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('JS')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ-UJgNW-U_SnJvWHweXdT6OlMmnNqtVI&libraries=places"></script>
<script src="{{ @url('/js/bootstrap3-typeahead.min.js') }}"></script>
<script src="{{ @url('/js/event-detail.js') }}"></script>
@endsection
