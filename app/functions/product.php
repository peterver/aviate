<?php

/*
 *   aviate - Page functions
 *
 *   Here's where all the stock functions for Aviate live.
 *   These functions only work when in the context of a
 *   page and handle everything to do with getting our
 *   page content and metadata aliased easily.
 */


/*
 *   products(array $filter, [string $order 'DESC'/'ASC'])
 *
 *   Return all products as an array, ready for looping with.
 *   Use like so:
 *
 *   @foreach(products() as $product)
 *    // Do whatever here. 
 *   @endforeach
 */
function products($filter = array(), $order = 'DESC') {
	return Products::where($filter)->orderBy('id', $order)->get();
}

/*
 *   products_by_category(int $category_id)
 *
 *   Return all products from a particular category as an array,
 *   ready for looping with. Use like so:
 *
 *   @foreach(products_by_category(2) as $product)
 *    // Do whatever here. 
 *   @endforeach
 */
function products_by_category($id) {
	return products(['category_id' => $id]);
}

/*
 *   has_products([array $filter])
 *
 *   Check if any products exist, optionally applying a filter
 *   to narrow results.
 *
 *   @if(!has_products())
 *     You need to sell some stuff!
 *   @endif
 */
function has_products($filter = array()) {
	return Products::where($filter)->exists();
}

/*
 *   has_products(int $category_id)
 *
 *   Alias has_products() to check by a category ID.
 *
 *   @if(!has_products(3))
 *     There's no products in category 3!
 *   @endif
 */
function has_products_by_category($id) {
	return has_products(['category_id' => $id]);
}

/*
 *   product_slug(Product $product)
 *
 *   Return the proper relative URL to a product.
 *   If you don't provide a valid $product from a loop
 *   nothing will be returned.
 */
function product_slug($product) {
	if(!is_object($product)) return false;

	return URL::to(
		join('/', [Category::slug($product->category_id), $product->slug)]
	);
}

/*
 *   product_image(Product $product, [string $size = 'medium'])
 *
 *   Return the proper relative URL to a product.
 *   If you don't provide a valid $product from a loop
 *   nothing will be returned.
 *
 *   @TODO
 */
function product_image($product, $size = 'medium') {
	return $product->gallery;
}