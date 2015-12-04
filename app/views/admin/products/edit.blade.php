@extends('admin/_layout')

@section('content')
	<h1>Editing “{{ $product->name }}”</h1>

	{{ Form::open(['class' => 'product-form', 'enctype' => 'multipart/form-data', 'files' => true]) }}
		<div class="wrap">
			<div class="image-uploader">
				<span>Drag an image here to upload</span>
				<input type="file" name="images">
				<input type="hidden" name="uploaded_image" value="{{ $product->gallery_id }}">

				@if($product->gallery and $product->gallery->image->url())
					<div class="preview" style="background-image: url({{ $product->gallery->image->url('medium') }})">
						<a class="remove">Remove image</a>
					</div>
				@endif
			</div>

			<div class="main-form">
				<div class="has-sub-field">
					<label for="name">Product name</label>
					<input name="name" placeholder="Product name" id="name" value="{{ Input::get('name', $product->name) }}">

					<div class="sub-field">
						<label for="slug">Product slug:</label>
						<code>/products/<span class="product-slug" data-editable="#slug" data-slugify="#name">{{ Input::get('slug', $product->slug) }}</span></code>
						
						<input hidden {{ Input::get('slug') ? 'data-modified="true"' : '' }} name="slug" id="slug" value="{{ Input::get('slug', $product->slug) }}">
						<a class="btn tiny" data-edit=".product-slug" data-onedit="Save slug">Edit slug</a>
					</div>
				</div>

				<div class="has-conditional">
					<span class="hint-wrapper">
						<label for="price">Product price</label>
						<input min="0" step="any" type="number" name="price" id="price" value="{{ Input::get('price', $product->price) }}">
						<span class="hint">{{ Currency::symbol() }}</span>
					</span>

					<span class="on-sale">
						<label for="onsale">On sale?</label>
						<select data-conditional=".has-conditional">
							<option value="true">Yes</option>
							<option selected value="false">No</option>
						</select>
					</span>

					<span class="sale-price-wrapper hint-wrapper">
						<label for="sale_price">Sale price</label>
						<input type="number" name="sale_price" id="sale_price" value="{{ Input::get('sale_price', $product->price) }}">
						<span class="hint">{{ Currency::symbol() }}</span>
					</span>
				</div>

				<div class="multi">
					<div>
						<label for="category_id">
							Product category
							<a class="btn tiny" href="{{ admin_url('categories/create') }}">Create new</a>
						</label>

						<select class="no-faux" id="category_id" name="category_id">
							<option value="1" disabled>Pick a category</option>
							@foreach(Category::all() as $category)
								<option {{ $category->id == $product->category_id ? 'selected' : '' }} value="{{ $category->id }}">
									{{ $category->name }}
								</option>
							@endforeach
						</select>
					</div>

					<div>
						<label for="stock">Stock amount</label>
						
						<input type="number" name="stock" id="stock" value="{{ Input::get('stock', $product->stock) }}">
						<a data-infinite="#stock" class="btn small secondary toggle-infinite">&infin;</a>
					</div>
				</div>

				<div>
					<label for="description">Product description</label>
					<textarea name="description" id="description">{{ Input::get('description', $product->description) }}</textarea>
				</div>
			</div>
		</div>

		<div class="footer">
			<div class="wrap">
				@if($product->id > 1)
				<a href="{{ admin_url('products/delete/' . $product->id) }}" class="btn negative">Delete product</a>
				@endif

				<button type="submit">Create product</button>
			</div>
		</div>
	{{ Form::close() }}
@stop