@extends('install._layout')

@section('aside')
	<h1>Nice job! We’re all set up.</h1>
	<p>Hopefully you weren’t expecting more. Now you can log in to the admin panel and get everything set up!</p>

	<a class="btn" href="{{ URL::to('admin') }}">Log in to admin panel</a>
@stop