<?php

class ProductsController extends AdminController {

	public function getIndex() {
		return View::make('admin/products/index')->with('products', Products::all());
	}

	/**
	 *   Listen to 
	 */
	public function getCreate() {
		return View::make('admin/products/create');
	}

	/**
	 *   Handle post data and show our create form
	 */
	public function postCreate() {
		return self::getCreate();
	}
}