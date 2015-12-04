<?php

class ProductsController extends AdminController {

	public function getIndex() {
		return View::make('admin/products/index')->with('products', Products::orderBy('id', 'DESC')->get());
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
		$gallery = Gallery::create([
			'image' => Input::file('images')
		]);

		$fields = Input::except('images', '_token');

		$fields['gallery_id'] = $gallery->id;

		if($product = Products::create($fields)) {
			return Redirect::to(admin_path('products/edit/' . $product->id));
		}

		View::share('error', 'Couldn’t create your product.');
		
		return self::getCreate();
	}

	/**
	 *   Handle post data and show our create form
	 */
	public function postEdit($id = false) {
		$product = Products::find($id);

		if(!$product) {
			return Redirect::to(admin_path('products'));
		}

		$input = Input::except('images', '_token');

		//  Update the gallery.
		if($product->gallery_id != array_get($input, 'uploaded_image')) {
			//  Grab our gallery
			$gallery = Gallery::find($product->gallery_id);

			//  Set it to the image if it exists - if not
			//  use STAPLER_NULL to remove it.
			$gallery->image = fallback(Input::file('images'), STAPLER_NULL);

			//  Save the database
			$gallery->save();

			//  Whatever gallery ID gets returned we update
			$input['gallery_id'] = $gallery->id;
		}

		$product->fill($input);

		if(!$product->save()) {
			View::share('error', 'Something went wrong.');
		} else {
			View::share('msg', 'Product updated!');
		}
		
		return self::getEdit($id);
	}

	public function getEdit($id = false) {
		return View::make('admin/products/edit')->with('product', Products::find($id));
	}

	public function getDelete($id = false) {
		$product = Products::find($id);

		if($product) {
			$product->delete();
		}

		return Redirect::to(admin_path('products'));
	}
}