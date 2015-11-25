<div class="container wrap">
@foreach(get_products() as $product)
	<div class="product">
		<a href="{{ get_product_slug($product) }}">
			{{ $product->name }}
		</a>
	</div>
@endforeach