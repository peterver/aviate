<?php

class CategoriesController extends AdminController {
	public function getIndex() {
		return View::make('admin/categories/index');
	}

	public function postIndex() {
		Former::populate(Input::all());

		if($category = Category::create(Input::except('_token'))) {
			return Redirect::to('admin/categories/edit/' . $category->id);
		}

		return self::getIndex();
	}

	public function getEdit() {
		$category = Category::current();

		//  If the category doesn't exist, don't throw a 404
		//  just go back to the main page, likely a URL mistype
		if(!$category) {
			return Redirect::to('admin/categories');
		}

		//  Update our form data
		Former::populate($category);

		//  Pass the category back to our view in case we need it
		return View::make('admin/categories/edit')->with('category', $category);
	}

	public function postEdit() {
		$category = Category::current();

		$category->fill(Input::except('_token'));

		if(!$category->save()) {
			View::share('error', 'Something went wrong.');
		} else {
			View::share('msg', 'Category updated!');
		}

		return self::getEdit();
	}

	public function getDelete() {
		$category = Category::current();

		if($category) {
			$category->delete();
		}

		return Redirect::to('admin/categories');
	}
}