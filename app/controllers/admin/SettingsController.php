<?php

class SettingsController extends AdminController {
	public function getIndex() {
		Former::populate(Metadata::getAll());

		return View::make('admin/settings/index');
	}

	public function postIndex() {
		$input = Input::except('_token');

		Former::populate($input);

		foreach($input as $key => $field) {
			Metadata::set($key, $field);
		}

		View::share('msg', 'Settings updated!');

		return self::getIndex();
	}
}