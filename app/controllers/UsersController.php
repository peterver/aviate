<?php

class UsersController extends AdminController {

	protected $layout;

	public function getLogin() {
		return View::make('admin/login');
	}

	public function getLogout() {
		Plugin::fire('admin.logout', Auth::user());
		Auth::logout();

		return Redirect::to(Config::get('admin_location') . '/login');
	}

	public function postLogin() {
		$fields = Input::only('email', 'password');

		if(Auth::attempt($fields)) {
			Plugin::fire('admin.login', Auth::user());

			return Redirect::intended(Config::get('admin_location'));
		}

		View::share('error', 'Your username or password ain’t right.');

		return self::getLogin();
	}

	public function getIndex() {
		return View::make('admin/users/list')->with('users', User::all());
	}
}
