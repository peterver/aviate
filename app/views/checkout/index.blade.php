<div class="wrap">
	<div class="primary">
		<b>You’re buying…</b>


		<table>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>

			@foreach(Basket::getContents() as $item)
			<tr class="product-{{ $item->id }}">
				<td class="name">
					{{ $item->name }}

					<span>{{ excerpt($item->description, 12) }}</span>

					@if($item->gallery and $item->gallery->image->url('small'))
					<img src="{{ $item->gallery->image->url('small') }}" alt="{{ $item->name }}" class="thumbnail">
					@endif
				</td>

				<td class="price">{{ Currency::price($item->price) }}</td>
				<td class="quantity">
					&times; {{ $item->quantity }}
				</td>

				<td class="total">
					{{ Currency::price($item->total_price) }}
				</td>
			</tr>
			@endforeach
		</table>
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