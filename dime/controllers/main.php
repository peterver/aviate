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
		parent::__construct();
		
		//  Load the installer helper, which will handle redirection for us
		$this->helper->load('installer');
		
		//  Set some defaults to use our custom theme paths instead of
		//  Scaffold's defaults, make it a bit more discoverable
		$this->template->set(array(
			'view_base' => TEMPLATE_BASE . 'views/',
			'partial_base' => TEMPLATE_BASE . 'partials/'
		));
	}
	
	public function index() {
		echo $this->template->render('index');
	}
}