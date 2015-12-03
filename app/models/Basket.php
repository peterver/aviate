<?php

class Basket extends Eloquent {

	protected $table = 'baskets';
	protected $fillable = array('session', 'data');

	public static $hash;
	public static $basket;

	public static function generate() {
		self::$hash = Hash::make(time());
		
		Session::set('aviate_basket', self::$hash);

		return self::create(array(
			'session' => self::$hash,
			'data' => json_encode('')
		));
	}

	public static function flush() {
		self::whereSession(Session::get('aviate_basket'))->delete();
		Session::forget('aviate_basket');
	}

	public static function add() {
		$items = self::items();
		$data = json_decode();
	}

	public static function items() {
		if(!Session::get('aviate_basket')) {
			self::generate();
		}

		return Basket::whereSession(Session::get('aviate_basket'))->first();
	}

	public static function itemCount() {
		return count(self::items());
	}
}
