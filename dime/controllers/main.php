<?php defined('IN_APP') or die('Get out of here');

/**
 *   Dime: Main controller
 *
 *   This handles loading the storefront, but also checks for the existence of valid
 *   config and system requirements. If it doesn't fit, it'll go to the installer to
 *   try and sort that out.
 */

class Main_controller extends Controller {
	//  Extend the main controller
	//  We can also put anything we want to show in any controller method here
	//  You know, so we don't repeat ourselves.
	//  You know, so we don't repeat ourselves.
	public function __construct() {
		//  All global helpers get loaded here
		//  If you REALLY need to edit or remove something like that
		//  you're probably doing it wrong, but the file is in:
		//  [/path/to/dime]/scaffold/defaults/controller.php
		parent::__construct();
	}
	
	public function index() {
		//  Get the current page we're on
		$page = max(1, (int) $this->url->segment(1));
		
		//  And set the products for that page
		$this->template->set(array(
			'products' => $this->model->paged($page)
		));
		
		//  Render our view
		echo $this->template->render('index');
	}
}