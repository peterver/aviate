@extends('admin/_layout')

@section('content')
	<h1>Products</h1>

	<div class="grid">
		@forelse($products as $product)
			<div class="grid-tile product">
				<a href="{{ admin_url('products/edit/' . $product->id) }}">
					<b>{{ $product->name }}</b>
				</a>
			</div>
		@empty
			<span class="empty-state">
				<span>No products! Would you like to add one now?</span>
				<a class="btn" href="{{ admin_url('products/create') }}">Sure, let’s sell some product</a>
			</span>
		@endforelse
	</div>
@stop