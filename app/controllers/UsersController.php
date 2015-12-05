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

	public function getEdit($id = false) {
		$user = User::find($id);

		if(!$user) {
			return Redirect::to(Config::get('admin_location') . '/users');
		}

		Former::populate($user);

		return View::make('admin/users/edit')->with(array(
			'user' => $user,
			'users' => User::all()
		));
	}

	public function postEdit($id = false) {
		$user = User::find($id);

		$input = Input::except('_token');

		if(!$input['password']) {
			unset($input['password']);
		}

		$user->fill($input);

		if(!$user->save()) {
			View::share('error', 'Something went wrong.');
		} else {
			View::share('msg', 'User updated!');
		}

		return self::getEdit($id);
	}

	public function getCreate() {
		return View::make('admin/users/create')->with(array(
			'users' => User::all()
		));
	}

	public function postCreate() {
		$input = Input::except('_token');

		if($user = User::create($input)) {
			return Redirect::to(admin_path('users/edit/' . $user->id));
		}

		View::share('error', 'Couldn’t create that user.');

		return self::getCreate();
	}
}
