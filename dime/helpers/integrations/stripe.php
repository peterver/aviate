<?php defined('IN_APP') or die('Get out of here');

/**
 *   Stripe integration
 *   
 */
class Stripe extends Payment {
	private static $key = false;
	private static $path = 'stripe/Stripe.php';
	
	public static function init($key) {
		if(!file_exists(self::$path)) {
			return false;
		}
		
		include_once $path;
		
		self::$key = $key;
	}
	
	public static function charge($amount, $card, $to) {
		$opts = array(
			//  Make sure it's in cents
			'amount' => $amount * (strpos($amount, '.') !== false ? 100 : 1),
			
			//  We can't charge in anything else, so force USD
			'currency' => 'usd',
			
			//  Customer details
			'card' => $card,
			'description' => $to
		);
		
		return Stripe_Charge::create($opts);
	}
}
