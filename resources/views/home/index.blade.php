@extends('shared.layout')

@section('CSS')
<link rel="stylesheet" href="{{ asset('/css/homepage.css') }}" />
@endsection

@section('Content')
<h1>Welcome to EventPlanner</h1>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
@if(Session::has('user'))
<a class="btn btn-primary" href="{{ url('/events') }}">Go to my events</a>
@else
<a class="btn btn-primary" href="{{ url('/user/register') }}">Register now</a>
<a href="{{ url('/user/login') }}">Login with your account</a>
@endif

@endsection
