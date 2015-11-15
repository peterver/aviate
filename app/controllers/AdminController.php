<?php

class AdminController extends BaseController {

	protected $layout;

	public function __construct() {
	    return $this->beforeFilter('auth|install');
	}

	public function getIndex() {
		$this->layout = array(
			//'users' => User::parse(),
			'theme' => 'current',
			'pages' => array(
				'products', 'categories', 'pages', 'purchases'
			)
		);
		
		return View::make('admin/index')->with($this->layout);
	}

	public function getUsers() {
		return View::make('admin/users');
	}
}
