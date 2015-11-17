@extends('admin/_layout')

@section('content')
	<h1>Products</h1>

	@forelse($products as $product)
		<div class="grid-tile product">
			<b>{{ $product->name }}</b>
		</div>
	@empty
		<span class="empty-state">
			<span>No products! Would you like to add one now?</span>
			<a class="btn" href="{{ URL::to('admin/products/create') }}">Sure, let’s sell some product</a>
		</span>
	@endforelse
@stop