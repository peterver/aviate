<?php

class PagesController extends AdminController {
	public function getIndex() {
		return View::make('admin/pages/index');
	}

	public function postIndex() {
		Former::populate(Input::all());

		if($page = Page::create(Input::except('_token'))) {
			return Redirect::to(admin_path('pages/edit/' . $page->id));
		}

		return self::getIndex();
	}

	public function getEdit($id = false) {
		$page = Page::find($id);

		//  If the Page doesn't exist, don't throw a 404
		//  just go back to the main page, likely a URL mistype
		if(!$page) {
			return Redirect::to(admin_path('pages'));
		}

		//  Update our form data
		Former::populate($page);

		//  Pass the Page back to our view in case we need it
		return View::make('admin/pages/edit')->with('page', $page);
	}

	public function postEdit($id = false) {
		$page = Page::find($id);

		//  Update our Page
		$page->fill(Input::except('_token'));

		//  And save to the database, returning a message either way
		if(!$page->save()) {
			View::share('error', 'Something went wrong.');
		} else {
			View::share('msg', 'Page updated!');
		}

		return self::getEdit();
	}

	public function getDelete($id = false) {
		$page = Page::find($id);

		if($page) {
			$page->delete();
		}

		return Redirect::to(admin_path('pages'));
	}
}