<?php defined('IN_APP') or die('Get out of here');

/**
 *   Dime
 *   Payment engine, delegates to whatever method is set in the config
 *   
 */
class Payment {
	public static $method = false;
	
	public static function init() {
		self::$method = Config::get('payment_method');
		
		return fetch(APP_BASE . 'helpers/integrations/' . self::$method . '.php');
	}
}