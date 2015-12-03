<div class="product">
	<a href="{{ get_product_slug($product) }}">
		@if($product->gallery)
			<img src="{{ $product->gallery()->medium }}" alt="Image for {{ $product->name }}">
		@endif

		<img src="{{ get_asset_url('kitten.jpg') }}" alt="Image for {{ $product->name }}">

		<span class="category">{{ $product->category->name }}</span>

		<b class="title">
			{{ $product->name }}

			<span class="price">{{ Currency::price($product->price) }}</span>
		</b>

		<p>{{ excerpt($product->description, 16) }}</p>
	</a>
</div>