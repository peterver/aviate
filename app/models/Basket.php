<?php

class Basket extends Eloquent {

	protected $table = 'baskets';
	protected $fillable = array('session', 'data');

	public static $hash;
	public static $basket;

	public function getDataAttribute($value) {
		return json_decode($value);
	}

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

	public static function getBasket() {
		return self::whereSession(Session::get('aviate_basket'))->first();
	}

	public static function add($data) {
		$item = self::getBasket();

		$item->data = json_encode($data);

		return $item->save();
	}

	public static function items() {
		if(!Session::get('aviate_basket')) {
			self::generate();
		}

		return self::getBasket()->data;
	}

	public static function itemCount() {
		return count(self::items());
	}
}
