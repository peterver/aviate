<?php defined('IN_APP') or die('Get out of here');

/**
 *   Paypal integration
 *   
 */
class Paypal {
	private static $email = false;
	
	public static function init() {
		self::$email = true;
		
		echo 'niit';
	}
}