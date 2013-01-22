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
		$db = self::$_db->insert()->into('baskets')->values(array(
			null, $str, ip_address(), $products, time(), 'active'
		))->go();
		
		return $str;
	}
	
	/**
	 *   Remove an item from the basket
	 */
	public static function remove($id) {
		//  No basket? Nothing to remove.
		if(self::current() === false) return true;
		
		//  Remove from list
		foreach(self::$_basket->productArray as $key => $product) {
			if($product == $id) {
				unset(self::$_basket->productArray[$key]);
				break;
			}
		}
		
		//  Update the list
		return self::update();
	}
	
	/**
	 *   And delete the basket
	 */
	public static function delete() {
		self::$_db->delete()->from('baskets')->where(array('slug' => self::$_slug))->go();
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
		
		if(!self::contains($num)) {
			self::$_basket->productArray[] = $num . '';
		}
		
		return self::update();
	}
	
	public static function contains($num) {
		if(!self::current('products')) {
			return false;
		}
		
		return in_array($num, self::$_basket->productArray);
	}
	
	public static function update($wat = false) {
		if(self::current() === false) {
			self::create($num);
		}
		
		if($wat === false) {
			$wat = array('products' => join(',', self::$_basket->productArray));
		}
		
		return !!self::$_db->update('baskets')->set($wat)->where(array(
			'slug' => Session::get('dime_basket', false)
		))->go();
	}
	
	//  Check whether a basket has items
	public static function hasItems() {
		return self::itemCount() > 0;
	}
	
	//  Get a count of the items
	//  You have Basket::itemCount() items in your basket, etc.
	public static function itemCount() {
		$items = self::current('products');
		
		//  count(false) == 1? Seriously, PHP? -_-
		if($items !== false and empty($items)) {
			return 0;
		}
		
		return count(self::items());
	}
	
	public static function items() {
		return self::current('items');
	}
	
	public static function value() {
		$value = 0;
		
		foreach(self::items() as $item) {
			$value += $item->price;
		}
		
		return $value;
	}
	
	public static function get($me) {
		if(self::$_basket === false) {
			$basket = self::$_db->select('*')->from('baskets')->where(array(
				'slug' => $me
			))->fetch();
			
			$basket->items = array();
			
			if(!empty($basket->products)) {
				$basket->productArray = explode(',', $basket->products);
				
				foreach($basket->productArray as $product) {
					$basket->items[] = self::$_db->select('*')->from('products')->where(array(
						'id' => $product
					))->fetch();
				}
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
	
	public static function status($set = false) {
		//  Getting
		if($set === false) {
			return self::current('status');
		}
		
		//  Setting
		return self::update(array('status' => $wat));
	}
}