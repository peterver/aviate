<div class="container wrap">

	@include('theme::partials/banner')

	<div class="products">
		@foreach(get_products() as $product)
			@include('theme::partials/product')
		@endforeach
	</div>
</div>