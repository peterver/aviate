<div class="wrap">
	<div class="primary">
		<b>You’re buying…</b>

		{{ var_dump(Basket::getContents()) }}
	</div>

	{{ Form::open(['class' => 'secondary']) }}
		<b>A little bit about you.</b>

		<p>
			<label for="name">Your name</label>
			<input name="name" id="name" placeholder="John Doe">
		</p>

		<p>
			<label for="email">Email address</label>
			<input type="email" name="email" id="email" placeholder="john.doe@gmail.com">
		</p>

		<button type="submit" class="btn positive">Next step</button>
	{{ Form::close() }}
</div>