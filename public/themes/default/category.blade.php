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
		@foreach(get_products_by_category($category->id) as $product)
			{{ $product->name }}
		@endforeach
	@else
		No products found! :(
	@endif
</div>