<div class="container wrap">
	<div class="products">
		@foreach(get_products() as $product)
			@include('theme::partials/product')
		@endforeach
	</div>
</div>