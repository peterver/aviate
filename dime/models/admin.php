<?php defined('IN_APP') or die('Get out of here');

class Admin_model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function findUser($username, $password) {
		$password = Input::hash($password);
		
		return first($this->db->select('*')->from('users')->where(array(
			'username' => $username,
			'password' => $password
		))->fetch());
	}
	
	public function findProduct($id) {
		$product = first($this->db->select('*')->from('products')->where(array('id' => $id))->fetch());
		
		return $this->_format($product);
	}
	
	public function allProducts() {
		$products = $this->db->select('*')->from('products')->fetch();
		$return = array();
		
		foreach($products as $id => $product) {
			$return[$id] = $this->_format($product);
		}
		
		return $return;
	}
	
	private function _format($product) {
		$product->oos = $product->current_stock < 1;
		
		$product->tags = array();
			
		if($product->oos) {
			$product->tags[] = 'Out of stock';
		} else if(($product->current_stock / $product->total_stock) < .1) {
			$product->tags[] = 'Low stock';
		}
		
		if($product->discount > 0) {
			$product->tags[] = 'Discounted ' .  $product->discount . '%';
		}
		
		if(!$product->visible) {
			$product->tags[] = 'Hidden';
		}
		
		return $product;
	}
}