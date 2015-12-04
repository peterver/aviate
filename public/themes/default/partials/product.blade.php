<div class="product">
	<a href="{{ get_product_slug($product) }}">
		@if($product->gallery)
		<span class="img-wrap">
			<img src="{{ dd($product->gallery) }}" alt="Image for {{ $product->name }}">
		</span>
		@endif

		<span class="category">{{ $product->category->name }}</span>

		<b class="title">
			{{ $product->name }}

			<span class="price">{{ Currency::price($product->price) }}</span>
		</b>

		<p>{{ excerpt($product->description, 16) }}</p>
	</a>
</div>