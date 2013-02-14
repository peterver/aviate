<?php defined('IN_APP') or die('Get out of here');

/**
 *   Dime
 *   Payment engine, delegates to whatever method is set in the config
 *   
 */
class Payment {
	public static $method = false;
	private static $file = false;
	
	public static function init($config = false) {
		self::$method = ucfirst(Config::get('payment_method', 'stripe'));
		self::$file = !fetch(APP_BASE . 'helpers/integrations/' . self::$method . '.php');
				
		if(self::$file !== false and class_exists(self::$method)) {
			call_user_func(self::$method . '::init', $config);
		}
	}
	
	public static function charge($amount, $for) {
		
	}
	
	public static function success() {}
	
	public static function fail() {}
}