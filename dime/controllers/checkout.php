<?php defined('IN_APP') or die('Get out of here');

class Checkout_controller extends Controller {
	public function __construct() {
		parent::__construct();
	}
	
	//  Load the main checkout page
	public function index() {
		echo $this->template->set(array(
			//  Get a list of all the current products in the basket
			'products' => Basket::items(),
			
			//  Set the title
			'title' => Config::get('sitename') . ' &mdash; Checkout',
			
			'class' => 'checkout'
		))->render('checkout');
	}
	
	public function remove() {
		//  Get the ID of the product
		$id = strval($this->url->segment(2));
		
		//  And remove it from the basket
		//  Then redirect to checkout
		Basket::remove($id) and Response::redirect('../');
	}
	
	public function buy() {
		Payment::charge(array(
			
		));
	}
}