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
		Plugin::fire('site.homepage');

		return Theme::render('index');
	}

	public function singlePage($slug = false) {
		//  If the page isn't found
		if(!Page::whereSlug($slug)->exists()) {
			return App::abort(404);
		}

		Plugin::fire('site.page');

		return Theme::render('page');
	}

	public function notFound() {
		Plugin::fire('site.not_found');

		return Theme::not_found();
	}

	public function categoryPage($category) {
		$category = Category::whereSlug($category)->first();

		if(!$category) {
			return $this->notFound();
		}

		$category = Plugin::fire('site.category_page', $category);

		View::share('category', $category);

		return Theme::render('category');
	}

	public function productPage($category, $slug) {
		$product = Products::whereSlug($slug)->first();

		if(!$product) {
			return $this->notFound();
		}

		$product = Plugin::fire('site.product_page', $product);

		View::share([
			'product' => $product,
			'category' => Category::whereSlug($category)->first()
		]);

		return Theme::render('product');
	}

	public function basketPage() {
		$basket = Plugin::fire('site.basket_page', Basket::getContents());

		View::share('basket', $basket);

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
