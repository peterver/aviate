@extends('admin/_layout')

@section('content')
	<h1>Site settings</h1>

	{{ Form::open() }}
		<p>
			{{ Former::text('site_name')->label('Site name') }}
			<em class="help">What’s your shop called?</em>
		</p>

		<p>
			{{ Former::textarea('site_desc')->label('Site description') }}
			<em class="help">Write a little description about your shop.</em>
		</p>

		<p>
			{{ Former::text('stripe_key')->label('Stripe key') }}
			<em class="help">It’s the <b>secret</b> one. This is required to take any payments. You can sign up for a free <a href="//stripe.com">Stripe account here</a>; if you’ve already got a Stripe account, you can get your API key <a href="//dashboard.stripe.com/account/apikeys">here</a>.</em>
		</p>

		{{ Former::button('Update settings')->type('submit') }}
	{{ Form::close() }}
@stop