<?php

class AdminController extends BaseController {

	public function __construct() {
		View::share(array(
			'theme' => get_current_theme(),
			'pages' => array_merge(
				array('products', 'categories', 'pages', 'purchases'),
				Plugin::fire('admin.nav-actions')->get()
			),

			'results' => array_merge(
				array(
					'Users' => admin_path('users'),
					'Settings' => admin_path('settings'),
					'Log out' => admin_path('logout')
				),

				Plugin::fire('admin.nav-results')->get()
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
