<?php

class SiteController extends BaseController {

	protected $layout;
	
	public function homepage() {
		return View::make('theme::index');
	}

	public function singlePage() {
		//  If the page isn't found
		if(!Page::whereSlug(Request::segment(2))->exists()) {
			return App::abort(404);
		}

		return View::make('theme::page');
	}

	public function notFound() {
		return Response::view('theme::not_found', array(), 404);
	}
}
