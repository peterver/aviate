<?php defined('IN_APP') or die('Get out of here');

/**
 *   Dime: Main controller
 *
 *   This handles loading the storefront, but also checks for the existence of valid
 *   config and system requirements. If it doesn't fit, it'll go to the installer to
 *   try and sort that out.
 */

class Page_controller extends Controller {
	//  Extend the main controller
	//  We can also put anything we want to show in any controller method here
	public function __construct() {
		parent::__construct();
	}
	
	//  Going to /static doesn't do anything
	//  So go back to the homepage
	public function index() {
		Response::redirect('../');
	}
	
	public function single() {
		$data = $this->model->find($this->url->segment(1));
		
		//  If there weren't any results
		if(!is_object($data)) {
			echo $this->template->render('404');
			return;
		}
		
		//  Add a plugin hook
		Plugin::receive('static_page', $data);
		
		//  Handle redirecting URLs
		if($data->redirect) return Response::redirect($data->redirect);
		
		//  Set the page title
		$this->template->set('title', Config::get('sitename') . ' &mdash; ' . $data->title);
				
		//  And output
		echo $this->template->set('data', $data)->render('page');
	}
}