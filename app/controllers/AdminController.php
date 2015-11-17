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

	public function getProductsEdit() {
		$product = Products::whereId(Request::segment(4))->first();
		
		if(!$product) {
			return Redirect::to('admin/products');
		}

		return View::make('admin/products/edit')->with('product', $product);		
	}

	public function getProductsCreate() {
		return View::make('admin/products/create');
	}

	public function postProductsCreate() {
		$fields = Input::except('_token');

		$fields['gallery_id'] = 0;
		
		if($product = Products::create($fields)) {
			return Redirect::to('admin/products/edit/' . $product->id);
		}

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

		View::share('error', 'Your username or password ain’t right.');

		return self::getLogin();
	}
}
