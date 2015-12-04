@extends('admin/_layout')

@section('content')
	<h1>Create a new product</h1>

	{{ Form::open(['action' => 'ProductsController@postCreate', 'method' => 'POST', 'class' => 'product-form', 'files' => true]) }}
		<div class="wrap">
			<div class="image-uploader">
				<span>Drag an image here to upload</span>
				<input type="file" name="images">
			</div>

			<div class="main-form">
				<div class="has-sub-field">
					<label for="name">Product name</label>
					<input name="name" placeholder="Product name" id="name" value="{{ Input::get('name') }}">

					<div class="sub-field">
						<label for="slug">Product slug:</label>
						<code>/products/<span class="product-slug" data-editable="#slug" data-slugify="#name">{{ Input::get('slug') }}</span></code>
						
						<input hidden {{ Input::get('slug') ? 'data-modified="true"' : '' }} data-slugify="#name" name="slug" id="slug" value="{{ Input::get('slug') }}">
						<a class="btn tiny" data-edit=".product-slug" data-onedit="Save slug">Edit slug</a>
					</div>
				</div>

				<div class="has-conditional">
					<span class="hint-wrapper">
						<label for="price">Product price</label>
						<input min="0" step="any" type="number" name="price" id="price" value="{{ Input::get('price') }}">
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
						<input type="number" name="sale_price" id="sale_price" value="{{ Input::get('sale_price') }}">
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
							<option value="1" disabled selected>Pick a category</option>
							@foreach(Category::all() as $category)
								<option value="{{ $category->id }}">{{ $category->name }}</option>
							@endforeach
						</select>
					</div>

					<div>
						<label for="stock">Stock amount</label>
						
						<input type="number" name="stock" id="stock" value="{{ Input::get('stock') }}">
						<a data-infinite="#stock" class="btn small secondary toggle-infinite">&infin;</a>
					</div>
				</div>

				<div>
					<label for="description">Product description</label>
					<textarea name="description" id="description">{{ Input::get('description') }}</textarea>
				</div>
			</div>
		</div>

		<div class="footer">
			<div class="wrap">
				<button type="submit">Create product</button>
			</div>
		</div>
	{{ Form::close() }}
@stop