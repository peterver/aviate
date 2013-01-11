<?php defined('IN_APP') or die('Get out of here');

class Checkout_controller extends Controller {
	public function __construct() {
		parent::__construct();
	}
	
	//  Load a single product page
	public function index() {
		echo $this->template->set(array(
			'products' => Basket::items(),
			'title' => Config::get('sitename') . ' &mdash; Checkout'
		))->render('checkout');
	}
	
	public function remove() {
		//\\//\\//\\//\\
	}
}