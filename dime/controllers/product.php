<?php defined('IN_APP') or die('Get out of here');

class Product_controller extends Controller {
	public function __construct() {
		parent::__construct();
		
		$this->product = $this->model->get($this->url->segment(1));
		
		if(empty($this->product)) {
			echo $this->template->render('404');
			return;
		}
	}
	
	//  Load a single product page
	public function index() {
		if(!$this->product) return;
		
		echo $this->template->set(array(
			'product' => $this->product,
			'title' => $this->product->name . ' &mdash; ' . Config::get('sitename')
		))->render('product');
	}
	
	//  Add to basket
	public function add() {
		$add = $this->model->buy($this->product->id) !== false;
		
		if(isset($_GET['ajax'])) {
			return Ajax::output(array(
				'status' => $add
			));
		}
		
		Response::redirect(PUBLIC_PATH . 'checkout');
	}
	
	//  Main product page
	//  We want to make this go back to the index, since there's nothing here
	public function back() {
		Response::redirect('../');
	}
}