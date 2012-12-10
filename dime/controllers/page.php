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
	//  You know, so we don't repeat ourselves.
	//  You know, so we don't repeat ourselves.
	public function __construct() {
		parent::__construct();
		
		//  Get some helpers in
		$this->helper->load(array(
			//  Load the installer helper, which will handle redirection for us
			'installer',
			
			//  Load the Basket helper so we can see our basket data in views
			'basket'
		));
	}
	
	public function index() {
		Response::redirect('../');
	}
	
	public function single() {
		echo $this->template->set('data', $this->model->find($this->url->segment(1)))->render();
	}
}