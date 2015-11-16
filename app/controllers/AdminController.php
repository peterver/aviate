<?php

class AdminController extends BaseController {

	protected $layout;

	public function __construct() {
		View::share(array(
			//'users' => User::parse(),
			'theme' => 'current',
			'pages' => array(
				'products', 'categories', 'pages', 'purchases'
			)
		));

	    return $this->beforeFilter('auth|install');
	}

	public function getIndex() {
		return View::make('admin/index');
	}

	public function getProducts() {
		View::share('products', Products::all());
		
		return View::make('admin/products/index');
	}

	public function getProductsCreate() {
		return View::make('admin/products/create');
	}

	public function postProductsCreate() {
		View::share('error', 'Something went wrong.');
		return self::getProductsCreate();
	}

	public function getUsers() {
		return View::make('admin/users');
	}

	public function getLogin() {
		return View::make('admin/login');
	}

	public function getLogout() {
		Auth::logout();
		return Redirect::to('admin/login');
	}

	public function postLogin() {
		$fields = Input::only('email', 'password');

		if(Auth::attempt($fields)) {
			return Redirect::intended('admin');
		}

		return self::getLogin();
	}
}
