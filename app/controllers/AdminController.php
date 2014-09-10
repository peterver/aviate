<?php

class AdminController extends BaseController {

	protected $layout;

	public function getIndex() {
		$this->layout = array(
			'users' => User::parse(),
			'theme' => 'current',
			'pages' => array(
				'products', 'categories', 'pages', 'purchases'
			)
		);
		
		return View::make('admin.index')->with($this->layout);
	}

	public function getUsers() {
		$this->layout = array(
			'users' => User::parse(),
			'theme' => 'current',
			'pages' => array(
				'products', 'categories', 'pages', 'purchases'
			)
		);

		return View::make('admin.users.list')->with($this->layout);
	}
}
