<?php defined('IN_APP') or die('Get out of here');

class Product_model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function get($slug) {
		$product = first($this->db->select('*')->from('products')->where(array('slug' => $slug))->fetch());
		
		return $this->_format($product);
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