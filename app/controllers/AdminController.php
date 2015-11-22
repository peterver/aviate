<?php

class AdminController extends BaseController {

	public function __construct() {
		View::share(array(
			'theme' => get_current_theme(),
			'pages' => array(
				'products', 'categories', 'pages', 'purchases'
			),

			'results' => array(
				'/' => 'Visit site',
				'admin/users' => 'Users',
				'admin/settings' => 'Settings',
				'admin/logout' => 'Log out'
			),

			//  Basic plugin test
			'welcome_message' => Plugin::fire('admin.welcome_message', 'Welcome to Aviate!')->last()
		));

		//  Don't use Bootstrap-style inputs
		Former::framework('Nude');

	    return $this->beforeFilter('auth|install');
	}

	public function getIndex() {
		return View::make('admin/index');
	}

	public function notFound() {
		return self::getIndex();
	}
}
