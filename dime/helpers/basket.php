<?php defined('IN_APP') or die('Get out of here');

class Basket {
	private static $_basket = false;
	private static $_db = false;
	
	/**
	 *   Set the basket up.
	 *   Get the session and database, link the two up, and let's go.
	 */
	public static function init() {
		self::$_db = Storage::get('objects.database');
		$me = Session::get('basket', false);
		
		if($me !== false) {
			self::$_basket = self::$_db->select('*')->from('baskets')->where(array(
				'slug' => $me
			))->fetch();
		}
	}
	
	/**
	 *   Create a new basket in the database, and assign it in a session.
	 *   Set a 10-character random string. You're not going to realistically get collisions.
	 */
	public static function create() {
		//  Set the random string, 
		$str = random_string();
		Session::set('basket', $str);
	}
	
	public static function hasItems() {
		return true;
	}
	
	public static function itemCount() {
		return count(self::items());
	}
	
	public static function items() {
		return array('product', 'product', 'product');
	}
	
	public static function current() {
		//self
	}
}