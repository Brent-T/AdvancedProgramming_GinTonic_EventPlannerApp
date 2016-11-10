@extends('shared.layout')

@section('Content')
<h1>Events overview</h1>
<p>In this overview you can find all the current events</p>
<div class="card card-block">
	<h4 class="card-title">{{ $data['type'] }}</h4>
	<p class="card-text">{{ $data['value']['quote'] }}</p>
	<a href="#" class="card-link">More detail</a>
</div>

<div class="card card-block">
	<h4 class="card-title">{{ $data['type'] }}</h4>
	<p class="card-text">{{ $data['value']['quote'] }}</p>
	<a href="#" class="card-link">More detail</a>
</div>

<div class="card card-block">
	<h4 class="card-title">{{ $data['type'] }}</h4>
	<p class="card-text">{{ $data['value']['quote'] }}</p>
	<a href="#" class="card-link">More detail</a>
</div>
@endsection
