<section class="breadcrumbs">
	<div class="wrap">
		Basket
	</div>
</section>

<header class="site-title">
	<h1>Your basket</h1>
</header>

<div class="wrap">
	@if(!empty($basket))
		<table>
			<tr>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
			</tr>

			@foreach($basket as $item)
			<tr class="product-{{ $item->id }}">
				<td class="name">
					{{ $item->name }}

					<span>{{ excerpt($item->description, 12) }}</span>

					@if($item->gallery and $item->gallery->image->url('small'))
					<img src="{{ $item->gallery->image->url('small') }}" alt="{{ $item->name }}" class="thumbnail">
					@endif

					<a class="btn delete-item">&times;</a>
				</td>

				<td class="price">{{ Currency::price($item->price) }}</td>
				<td class="quantity">
					&times; {{ $item->quantity }}

					<a class="btn add-item">+</a>
					<a class="btn remove-item">-</a>
				</td>

				<td class="total">{{ Currency::price($item->total_price) }}</td>
			</tr>
			@endforeach
		</table>

		<a href="{{ URL::to('/basket/empty') }}">Clear yer basket</a>
	@else
		Nothing yet. Get buying!
	@endif
</div>