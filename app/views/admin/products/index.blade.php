@extends('admin/_layout')

@section('content')
	<h1>
		Products
		<a class="btn" href="{{ admin_url('products/create') }}">Create a new product</a>
	</h1>


	<div class="products">
		<div class="product-gutter"></div>

		@forelse($products as $product)
			<div class="product">
				<a href="{{ admin_url('products/edit/' . $product->id) }}">
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
		@empty
		@endforelse
	</div>

	<span class="empty-state">
		<span>No products! Would you like to add one now?</span>
		<a class="btn" href="{{ admin_url('products/create') }}">Sure, let’s sell some product</a>
	</span>
@stop

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.min.js"></script>

	<script>
		new Masonry('.products', {
			itemSelector: '.product',
			percentPosition: true,
			gutter: '.product-gutter'
		});
	</script>
@stop