@extends('install._layout')

@section('aside')
	<h1>Great! Your database is set up.</h1>
	<p>Now we just need to add some more information about you and your shop before we let you dig in.</p>
	<p>You can change any of this information at a later date: don’t worry too much if you get anything wrong.</p>
@stop

@section('content')
	{{ Form::open(array('autocomplete' => 'off')) }}
		<p>
			<label for="site_name">Your shop’s name</label>
			<input required maxlength="100" name="site_name" value="{{ Input::get('site_name') }}" id="sitename" placeholder="ACME Corp">

			<em class="help">You can call this whatever you’d like — of course. It’ll be used in a lot of places, so don’t be too descriptive, just the barebones shop name.</em>
		</p>

		<p>
			<label for="site_desc">Your shop’s description</label>
			<textarea required id="site_desc" name="site_desc" maxlength="160">{{ Input::get('site_desc') }}</textarea>

			<em class="help">Now’s your chance to get descriptive. This is what will get displayed under your site in Google search results.</em>
		</p>

		<p class="multi">
			<label for="user">Shop admin email address and password</label>
			<input required name="user" id="user" placeholder="Email address" value="{{ Input::get('user') }}">
			<input required name="pass" id="pass" type="password" placeholder="Password">

			<em class="help">Make sure you pick something memorable! You’ll need this to make <b>any</b> changes within Aviate. You can always create more users later on if you need to.</em>
		</p>

		<p>
			<label for="stripe_key">Stripe API key</label>
			<input required name="stripe_key" value="{{ Input::get('stripe_key') }}" id="stripe_key">

			<em class="help">This is required to take any payments. You can sign up for a free <a href="//stripe.com">Stripe account here</a>; if you’ve already got a Stripe account, you can get your API key <a href="//dashboard.stripe.com/account/apikeys">here</a>.</em>
		</p>

		<button type="submit">Next step</button>
	{{ Form::close() }}
@stop