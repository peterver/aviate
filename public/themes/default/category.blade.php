<section class="breadcrumbs">
	<div class="wrap">
		<a href="{{ URL::to($category->slug) }}">{{ $category->name }}</a>
	</div>
</section>

<header class="site-title">
	<h1>{{ $category->name }}</h1>
</header>

<div class="wrap">
	@if(has_products_by_category($category->id))
	<div class="products">
		<div class="product-gutter"></div>

		@foreach(products_by_category($category->id) as $product)
			@include('theme::partials/product')
		@endforeach
	</div>
	@else
		No products found! :(
	@endif
</div>