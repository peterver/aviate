@extends('install._layout')

@section('aside')
	<h1>Thanks for choosing Aviate! To get started, we’ll need access to a database and a Stripe account. Everything will be stored safely.</h1>
@stop

@section('content')
	{{ Form::open(array('autocomplete' => 'off')) }}
		<!-- Weird bug, weird fix. -->
		<!-- This fixes autocomplete highlighting the database username and password. -->
		<input type="text" style="display:none"><input type="password" style="display:none">

		<p>
			<label for="db_type">Database type</label>
			<select name="db_type" id="db_type">
			@foreach($databases as $key => $value)
				<option value="{{ $key }}">{{ $value }}</option>
			@endforeach
			</select>

			<em class="help">If you don’t know the database type, there’s a 99% chance it’s MySQL. Ask your host for more information.</em>
		</p>

		<p>
			<label for="db_host">Database host</label>
			<input required name="db_host" value="{{ Input::get('db_host', '127.0.0.1') }}" placeholder="127.0.0.1">

			<em class="help">If you’re not sure, it’s probably 127.0.0.1 or localhost. Ask your host for more information.</em>
		</p>

		<p class="multi">
			<label for="db_user">Database username and password</label>
			<input required name="db_user" placeholder="Database username" autocomplete="off" autocapitalize="off" value="{{ Input::get('db_user') }}">
			<input name="db_pass" placeholder="Database password" autocomplete="off" type="password" value="{{ Input::get('db_pass') }}">

			<em class="help">How do you normally connect to your database? Please enter the right credentials. Ask your host for more information.</em>
		</p>

		<p>
			<label for="db_name">Database name</label>
			<input required name="db_name" value="{{ Input::get('db_name') }}">

			<em class="help">What is the name of the database we’ve got access to? If it doesn’t already exist, Aviate will try to create it but this may not work; if not, you need to set it up with your host.</em>
		</p>

		<p>
			<label for="db_prefix">Table prefix</label>
			<input name="db_prefix" value="{{ Input::get('db_prefix', 'aviate_') }}">

			<em class="help">If you’re using one database for multiple sites, you might end up with a database clash. This prevents that happening. You can leave it blank if you want.</em>
		</p>

		<button type="submit">Next step</button>
	{{ Form::close() }}
@stop