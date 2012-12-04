<?php defined('IN_APP') or die('Get out of here');

class Basket {
	public static function hasItems() {
		return true;
	}
	
	public static function itemCount() {
		return count(self::items());
	}
	
	public static function items() {
		return array('product', 'product', 'product');
	}
}