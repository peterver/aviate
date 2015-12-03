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
		<ul class="basket-items">
		@foreach($basket as $item)
			<li>
				<b>{{ $item->name }}</b>
				<span>{{ Currency::price($item->price) }}</span>

				<em>&times; {{ $item->quantity }} = {{ Currency::price($item->total_price) }}</em>
			</li>
		@endforeach
		</ul>

		<a href="{{ URL::to('/basket/empty') }}">Clear yer basket</a>
	@else
		Nothing yet. Get buying!
	@endif
</div>