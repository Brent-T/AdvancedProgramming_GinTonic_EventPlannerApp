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
		@if ($event->owner == Session::get('user')->id)
		<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete" ><i class="fa fa-trash-o" aria-hidden="true"></i> Delete this event</button>
		@else
		<button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#unsubscribe" ><i class="fa fa-times" aria-hidden="true"></i> Can't make it</button>
		@endif
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
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		{!! Form::open(['url' => '/events/' . $event->id . '/delete', 'method' => 'POST', 'class' => 'form']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-danger" id="myModalLabel">Delete this event?</h4>
			</div>
			<div class="modal-body">
				<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 form-group">
				Are you sure you want to delete this event?
			</div>
		</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				{!! Form::submit('Detelete event', ['class' => 'btn btn-danger']) !!}
				{!! Form::hidden('event_id', $event->id) !!}
			</div>
		{!! csrf_field() !!}
		{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Modal Suggest location -->
<div class="modal fade" id="unsubscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		{!! Form::open(['url' => '/events/' . $event->id . '/unsubscribe', 'method' => 'POST', 'class' => 'form']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title text-danger" id="myModalLabel">Unsubscribe from event?</h4>
			</div>
			<div class="modal-body">
				<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 form-group">
				Are you sure you want to unsubscribe from this event?
			</div>
		</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				{!! Form::submit('Unsubscribe from event', ['class' => 'btn btn-danger']) !!}
				{!! Form::hidden('event_id', $event->id) !!}
			</div>
		{!! csrf_field() !!}
		{!! Form::close() !!}
		</div>
	</div>
</div>

<!-- Modal Add Item -->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		{!! Form::open(['url' => '/events/' . $event->id . '/additem', 'method' => 'POST', 'class' => 'form']) !!}
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add item</h4>
			</div>
			<div class="modal-body">
				<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 form-group">
					{!! Form::label('item', 'name:') !!}
					{!! Form::text('item', '', ['class' => 'form-control' ]) !!}
					{!! Form::label('description', 'description:') !!}
					{!! Form::text('description', '', ['class' => 'form-control' ]) !!}
			</div>
		</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				{!! Form::submit('Add item', ['class' => 'btn btn-primary']) !!}
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
				<div class="row form-inline container custom-center">
					<div class="col-xs-8 col-sm-8 col-md-8 form-group">
						{!! Form::text('location', '', ['class' => 'form-control', 'id' => 'suggest', 'style' => 'width: 100%;']) !!}
						<!-- <button type="button" class="btn btn-outline-success form-control" ><i class="fa fa-user-plus" aria-hidden="true"></i> Add</button> -->
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 form-group">
						<button type="button" class="btn btn-outline-success form-control" id="add-person"><i class="fa fa-user-plus" aria-hidden="true"></i> Add</button>
					</div>
				</div>
				<div class="alert alert-danger person-does-not-exist" role="alert" style="display: none;">
					<strong>Sorry!</strong> This person does not exist.
				</div>
			</div>
		<div class="modal-footer"></div>
		<div class="modal-body invitees-box">
		<h5>To be invited</h5>
			<table class="table table-to-be-invited borderless">
				<tbody>
				</tbody>
			</table>
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
				@forelse ($invitees as $invitee)
				<tr>
					@if (file_exists(public_path( '/img/profilepictures/' . $invitee->id . '.jpg' )))
						<td><img class="invited-thumbnail" src="{{ asset('/img/profilepictures/' . $invitee->id . '.jpg') }}" alt=""></td>
					@else
						<td><img class="invited-thumbnail" src="{{ asset('/img/defaultprofilepicture.jpg') }}" alt=""></td>
					@endif
					<!-- <td><img class="invited-thumbnail" src="{{ asset('/img/defaultprofilepicture.jpg') }}"></td> -->
					<td class="text-xs-left vcenter-name">{{$invitee->firstname}} {{$invitee->surname}} @if ($invitee->id == Session::get('user')->id) (me) @endif</td>
					<!-- <td class="text-xs-left vcenter-name"><a href="" class="btn btn-outline-primary btn-sm">info</a></td> -->
				</tr>
				@empty
				<div class="alert alert-info" role="alert">
			  		<strong>Heads up!</strong> no invitees.
				@endforelse
			</tbody>
		</table>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-8">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="col-xs-8 col-sm-8 col-md-8">
				<h3>Items</h3>
			</div>
			<div class="col-xs-4 col-sm-4 col-md-4">
				<button type="button" class="btn btn-outline-primary btn-sm float-xs-right" data-toggle="modal" data-target="#addItem"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Add item</button>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-12">
			<table class="table table-suggestions">
			<tbody>
				@forelse ($items as $item)
				<tr>
					<td>{{$item->name}}</td>
					@if($item->description)
					<td><button type="button" class="btn btn-outline-primary btn-sm" data-container="body" data-toggle="popover" data-placement="bottom" data-content="{{$item->description}}">info</button></td>
					@else
					<td><button type="button" class="btn btn-outline-primary btn-sm disabled" data-container="body" data-toggle="popover" data-placement="bottom" data-content="{{$item->description}}">info</button></td>
					@endif
					<td><progress class="progress progress-success" value="{{$item->score}}" max="10"></progress></td>
					<td class="text-xs-center">
						{!! Form::open(['url' => '/events/' . $event->id . '/vote', 'method' => 'POST', 'class' => 'form']) !!}
							<button id="vote_pos" type="submit" name="vote_value" value="+1" class="btn btn-outline-success btn-sm"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
							<button id="vote_neg" type="submit" name="vote_value" value="-1" class="btn btn-outline-danger btn-sm"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
							{!! Form::hidden('event_id', $event->id) !!}
							{!! Form::hidden('item_id', $item->id) !!}
						{!! csrf_field() !!}
						{!! Form::close() !!}
					</td>
				</tr>
				@empty
				<div class="alert alert-info" role="alert">
			  		<strong>Heads up!</strong> There are no items listed for this event.
				@endforelse
			</tbody>
		</table>
		</div>
	</div>
</div>
@endsection

@section('JS')
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBJ-UJgNW-U_SnJvWHweXdT6OlMmnNqtVI&libraries=places"></script>
<script src="{{ @url('/js/bootstrap3-typeahead.min.js') }}"></script>
<script src="{{ @url('/js/event-detail.js') }}"></script>
@endsection
