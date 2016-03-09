<?php

class AdminController extends BaseController {

	public function __construct() {
		View::share(array(
			'theme' => current_theme(),
			'pages' => ['products', 'purchases'],

			'content' => [
				'Pages' => 'pages',
				'Themes' => 'themes',
				'Categories' => 'categories'
			],
			
			'plugins' => array_squish(Plugin::fire('admin.nav-actions')),

			'results' => array_merge(
				[
					'Users' => admin_path('users'),
					'Settings' => admin_path('settings'),
					'Log out' => admin_path('logout')
				],

				Plugin::fire('admin.nav-results')
			),

			//  Basic plugin test
			'welcome_message' => Plugin::trigger('admin.welcome_message', 'Welcome to Aviate!')->last()
		));

		//  Don't use Bootstrap-style inputs
		Former::framework('Nude');

	    return $this->beforeFilter('auth|install');
	}

	public function getIndex() {
		return View::make('admin/index');
	}

	public function notFound() {
		$slug = Plugin::trigger('admin.pages')->get(Request::segment(2));

		if($slug) {
			return View::make('admin/base')->nest('content', 'plugin::' . $slug);
		}

		return self::getIndex();
	}
}
