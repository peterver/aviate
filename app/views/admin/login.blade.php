@extends('admin/_auth')

@section('content')

{{ Form::open(['class' => 'auth']) }}

	{{ HTML::image('aviate/aviate-logo.png', 'Aviate CMS logo', ['class' => 'auth-logo', 'width' => 23, 'height' => 19]) }}

	@if(isset($error))
	<p class="error">{{ $error}}</p>
	@endif

	<p>
		<label for="email">Email address:</label>
		<input type="email" name="email" type="email" value="{{ Input::get('email') }}">
	</p>

	<p>
		<label for="password">Password:</label>
		<input type="password" name="password" type="password">
	</p>

	<button type="submit">Log in</button>

{{ Form::close() }}

@stop