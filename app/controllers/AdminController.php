<?php

class AdminController extends BaseController {

	public function __construct() {
		View::share(array(
			'theme' => get_current_theme(),
			'pages' => array(
				'products', 'categories', 'pages', 'purchases'
			)
		));

	    return $this->beforeFilter('auth|install');
	}

	public function getIndex() {
		return View::make('admin/index');
	}
}
