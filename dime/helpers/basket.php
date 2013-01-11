<?php defined('IN_APP') or die('Get out of here');

class Basket {
	private static $_basket = false;
	private static $_db = false;
	private static $_slug;
	
	/**
	 *   Set the basket up.
	 *   Get the session and database, link the two up, and let's go.
	 */
	public static function init() {
		self::$_db = Storage::get('objects.database');
	}
	
	/**
	 *   Create a new basket in the database, and assign it in a session.
	 *   Set a 10-character random string. You're not going to realistically get collisions.
	 */
	public static function create($products = '') {
		//  Generate the random string, 
		$str = random_string();
		
		//  Set it to a session for easy access
		self::$_slug = Session::set('dime_basket', $str);
		
		//  And insert it in the database so we don't forget it
		self::$_db->insert()->into('baskets')->values(array(
			null, $str, ip_address(), $products, time(), 'active'
		))->go();
		
		return $str;
	}
	
	/**
	 *   And delete the basket
	 */
	public static function remove() {
		self::$_db->remove()->from('baskets')->where(array('slug' => self::$_slug))->go();
		Session::destroy('dime_basket');
	}
	
	/**
	 *   Add an item to the basket. Pretty obvious, really.
	 */
	public static function add($num) {
		//  If we don't have a basket, might as well add one now
		if(self::current() === false) {
			return self::create($num);
		}
		
		if(!in_array($num, self::$_basket->products)) {
			self::$_basket->products[] = $num . '';
		}
		
		return self::$_db->update('baskets')->set(array(
			'products' => join(',', self::$_basket->products)
		))->where(array('slug' => self::$_slug))->fetch();
	}
	
	//  Check whether a basket has items
	public static function hasItems() {
		return self::itemCount() > 0;
	}
	
	//  Get a count of the items
	//  You have Basket::itemCount() items in your basket, etc.
	public static function itemCount() {
		//  count(false) == 1? Seriously, PHP? -_-
		if(self::items() === false) {
			return 0;
		}
		
		return count(self::items());
	}
	
	public static function items() {
		return self::current('items');
	}
	
	public static function get($me) {
		if(self::$_basket === false) {
			$basket = self::$_db->select('*')->from('baskets')->where(array(
				'slug' => $me
			))->fetch();
			
			$basket->products = explode(',', $basket->products);
			$basket->items = array();
			
			foreach($basket->products as $product) {
				$basket->items[] = self::$_db->select('*')->from('products')->where(array(
					'slug' => 'test'
				))->fetch();
			}
			
			self::$_basket = $basket;
		}
		
		return self::$_basket;
	}
	
	public static function current($key = false) {
		$me = Session::get('dime_basket', false);
		
		//  There's no basket yet
		if($me === false) {
			return false;
		}
		
		$get = self::get($me);
		
		if(isset($get->{$key})) {
			return $get->{$key};
		}
		
		return $get;
	}
}