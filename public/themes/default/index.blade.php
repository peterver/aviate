<div class="container wrap">

	@include('theme::partials/banner')

	<div class="products">
		<div class="product-gutter"></div>
		
		@foreach(products() as $product)
			@include('theme::partials/product')
		@endforeach
	</div>
</div>