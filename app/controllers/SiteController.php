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
}
