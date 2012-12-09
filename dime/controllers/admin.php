<?php defined('IN_APP') or die('Get out of here');

/**
 *   Dime: Admin controller
 *
 *   The main admin interface controller, which should handle being able to
 *   edit, control, and modify everything possible about the Dime shop.
 */

class Admin_controller extends Controller {
	public function __construct() {
		parent::__construct();
		
		//  Set the user session
		$this->session = Session::get(Config::get('session.user'), false);
		
		//  Bounce out if there's no session
		if($this->session === false and $this->url->segment(1) !== 'login') {
			Response::redirect('/admin/login');
		}
		
		//  Set the template path to the admin
		//  Since it's set as a static property and a constant,
		//  we have to do a bit of hacking. Ewww.
		$t = $this->template;
		$t::$templatepath = TEMPLATE_BASE . '/admin.html';
		
		$this->template->set(array(
			'partial_base' => TEMPLATE_BASE . 'partials/admin/',
			'view_base' => TEMPLATE_BASE . 'views/admin/',
			
			'loggedIn' => true,
			'url' => $this->url->segment(1)
		));
	}
	
	public function delegate() {
		$url = str_replace('_', '', $this->url->segment(1));
		
		if(method_exists($this, $url) and $url !== __FUNCTION__) {
			return $this->{$url}();
		}
		
		echo $this->template->render('404');
	}
	
	public function index() {
		echo $this->template->render('index');
	}
	
	public function products() {
		echo $this->template->set('products', $this->model->allProducts())->render('products');
	}
	
	public function product() {
		echo $this->template->set('product', $this->model->findProduct($this->url->segment(2)))
				  ->render('product');
	}
	
	public function addProduct() {
		echo $this->template->render('add_product');
	}
	
	public function login() {
		if($this->session !== false) {
			return Response::redirect('/admin');
		}
		
		//  We're not logged in, make sure you know that.
		$this->template->remove('loggedIn');
			
		//  Check if the username field is set
		//  If it is, we can assume they're trying to log in
		if($this->input->posted('username')) {
			$status = $this->model->findUser($this->input->post('username'), $this->input->post('password'));

			//  Log the user in
			if(is_object($status)) {
				unset($session->password);
				return Session::set(Config::get('session.user'), $status) and Response::redirect('/admin');
			}
						
			//  Slow down the response. You've been naughty.
			sleep(1);
			
			//  And show a message.
			$this->template->set('msg', 'Invalid username or password.');
		}
		
		echo $this->template->set('class', 'login')
				  ->render('login');
	}
	
	public function logout() {
		return Session::destroy(Config::get('session.user')) and Response::redirect('/admin/login');
	}
}