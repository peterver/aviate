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
	}
	
	public function index() {
		echo $this->template->render('admin/index');
	}
	
	public function login() {
		if($this->session !== false) {
			return Response::redirect('/admin');
		}
			
		//  Check if the username field is set
		//  If it is, we can assume they're trying to log in
		if($this->input->posted('username')) {
			$status = $this->model->findUser($this->input->post('username'), $this->input->post('password'));

			//  Log the user in
			if(is_object($status)) {
				return Session::set(Config::get('session.user'), $status) and Response::redirect('/admin');
			}
						
			//  Slow down the response. You've been naughty.
			sleep(1);
			
			//  And show a message.
			$this->template->set('msg', 'Invalid username or password.');
		}
		
		echo $this->template->set('class', 'login')
				  ->render('admin/login');
	}
	
	public function logout() {
		return Session::destroy(Config::get('session.user')) and Response::redirect('/admin/login');
	}
}