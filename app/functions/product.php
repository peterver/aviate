<?php

function get_products($filter = array()) {
	return Products::where($filter)->orderBy('id', 'DESC')->get();
}

function get_products_by_category($id) {
	return get_products(array('category_id' => $id));
}

function has_products($filter = array()) {
	return Products::where($filter)->exists();
}

function has_products_by_category($id) {
	return has_products(array('category_id' => $id));
}

function get_product_slug($product) {
	if(!is_object($product)) {
		return false;
	}

	return URL::to(
		join('/', array(Category::slug($product->category_id), $product->slug))
	);
}