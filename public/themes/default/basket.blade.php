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
				</td>

				<td class="price">{{ Currency::price($item->price) }}</td>
				<td class="quantity">
					&times; {{ $item->quantity }}

					<a href="{{ basket_increase_url($item) }}" class="btn add-item">+</a>
					<a href="{{ basket_decrease_url($item) }}" class="btn remove-item">-</a>
				</td>

				<td class="total">
					{{ Currency::price($item->total_price) }}
					
					<a href="{{ basket_remove_url($item) }}" class="btn delete-item">&times;</a>
				</td>
			</tr>
			@endforeach
		</table>

		<a href="{{ URL::to('/basket/empty') }}">Clear yer basket</a>
	@else
		Nothing yet. Get buying!
	@endif
</div>