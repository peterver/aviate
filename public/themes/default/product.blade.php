<section class="breadcrumbs">
	<div class="wrap">
		<a href="{{ URL::to($category->slug) }}">{{ $category->name }}</a> <span>&rsaquo;</span> {{ $product->name }}
	</div>
</section>

<div class="wrap">
	@if($product->image)
		<img src="{{ $product->image }}">
	@endif

	<div class="product-info">
		<h1>{{ $product->name }}</h1>
		<span class="price">{{ Currency::price($product->price) }}</span>

		<div class="product-description">
			{{ $product->description }}
		</div>

		{{ Form::open() }}
		<button type="submit">Buy for {{ Currency::price($product->price) }}</button>
		{{ Form::close() }}
</div>