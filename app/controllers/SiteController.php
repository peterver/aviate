<?php

class SiteController extends BaseController {

	protected $layout;
	
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
}
