<?php

class UsersController extends BaseController {

	protected $layout;

	public function getLogin() {
		return View::make('admin/login');
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::to(ADMIN_LOCATION . '/login');
	}

	public function postLogin() {
		$fields = Input::only('email', 'password');

		if(Auth::attempt($fields)) {
			return Redirect::intended(ADMIN_LOCATION);
		}

		View::share('error', 'Your username or password ain’t right.');

		return self::getLogin();
	}
}
