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
		$error = false;

		Gallery::create([
			'image' => Input::file('images')
		]);

		if($product = Products::create(Input::except('images', '_token'))) {
			return Redirect::to(admin_path('products/edit/' . $product->id));
		}

		View::share('error', 'Couldn’t create your product.');
		
		return self::getCreate();
	}
}