<div class="product">
	<a href="{{ product_slug($product) }}">
		@if($product->gallery)
		<span class="img-wrap">
			<img src="{{ URL::to($product->gallery->image->url('medium')) }}" alt="Image for {{ $product->name }}">
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