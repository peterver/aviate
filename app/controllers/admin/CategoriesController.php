<?php

class CategoriesController extends AdminController {
	public function getIndex() {
		return View::make('admin/categories/index');
	}

	public function postIndex() {
		Former::populate(Input::all());

		if($category = Category::create(Input::except('_token'))) {
			return Redirect::to(admin_path('categories/edit/' . $category->id));
		}

		return self::getIndex();
	}

	public function getEdit($id = false) {
		$category = Category::find($id);

		//  If the category doesn't exist, don't throw a 404
		//  just go back to the main page, likely a URL mistype
		if(!$category) {
			return Redirect::to(admin_path('categories'));
		}

		//  Update our form data
		Former::populate($category);

		//  Pass the category back to our view in case we need it
		return View::make('admin/categories/edit')->with('category', $category);
	}

	public function postEdit($id = false) {
		$category = Category::find($id);

		//  Update our category
		$category->fill(Input::except('_token'));

		//  And save to the database, returning a message either way
		if(!$category->save()) {
			View::share('error', 'Something went wrong.');
		} else {
			View::share('msg', 'Category updated!');
		}

		return self::getEdit();
	}

	public function getDelete($id = false) {
		$category = Category::find($id);

		if($category) {
			$category->delete();
		}

		return Redirect::to(admin_path('categories'));
	}
}