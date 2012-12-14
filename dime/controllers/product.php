<?php defined('IN_APP') or die('Get out of here');

class Product_controller extends Controller {
	public function __construct() {
		parent::__construct();
	}
	
	//  Load a single product page
	public function index() {
		$product = $this->model->get($this->url->segment(1));
		
		echo $this->template->set(array(
			'product' => $product,
			'title' => $product->name . ' &mdash; ' . Config::get('sitename')
		))->render('product');
	}
	
	//  Main product page
	//  We want to make this go back to the index, since there's nothing here
	public function back() {
		Response::redirect('../');
	}
}