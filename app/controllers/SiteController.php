<?php

class SiteController extends BaseController {

	/*
	 *   When SiteController gets instantiated we want
	 *   to also include the theme's functions.php (or
	 *   whatever it gets assigned as in metadata.json).
	 */
	public function __construct() {
		//  Get our theme's JSON includes as an array
		//  and save it for use later on.
		$includes = Theme::json('include');

		//  Right now we only allow an array of files
		//  (relative to theme root) to include.
		if(is_array($includes)) {
			foreach($includes as $include) {
				$path = theme_path($include);
				
				if(File::exists($path)) {
					include_once $path;
				}
			}
		}
	}
	
	public function homepage() {
		return Theme::render('index');
	}

	public function singlePage() {
		//  If the page isn't found
		if(!Page::whereSlug(Request::segment(2))->exists()) {
			return App::abort(404);
		}

		return Theme::render('page');
	}

	public function notFound() {
		return Theme::not_found();
	}

	public function categoryPage($category) {
		$category = Category::whereSlug($category)->first();

		if(!$category) {
			return $this->notFound();
		}

		View::share('category', $category);

		return Theme::render('category');
	}

	public function productPage($category, $slug) {
		$product = Products::whereSlug($slug)->first();

		if(!$product) {
			return $this->notFound();
		}

		View::share(array(
			'product' => $product,
			'category' => Category::whereSlug($category)->first()
		));

		return Theme::render('product');
	}

	public function basketPage() {
		View::share('basket', Basket::getContents());

		return Theme::render('basket');
	}

	public function basketUpdate($product_id = false) {
		if($product_id) {
			Basket::quantity($product_id, Input::get('quantity'));
		}

		return Redirect::action('SiteController@basketPage');	
	}

	public function basketEmpty() {
		Basket::flush();

		return Redirect::action('SiteController@basketPage');
	}

	public function buyProduct($category, $slug) {
		//  Product ID, quantity
		Basket::add(Products::whereSlug($slug)->first()->id, 1);

		return $this->productPage($category, $slug);
	}
}
