<?php

class Basket extends Eloquent {

	protected $table = 'baskets';
	protected $fillable = array('session', 'data');

	public static $hash;
	public static $basket;

	public function getDataAttribute($value) {
		//  If it's 2 characters or less, it's
		//  not a valid JSON string.
		if(strlen($value) < 3) return;

		$data = (array) json_decode($value);

		foreach($data as $key => $item) {
			//  Set price data and product data
			$data[$key]->product = Products::whereId($item->product_id)->first();
			$data[$key]->price = $data[$key]->product->price * $item->quantity;

			//  Remove the product ID as we don't need it any more.
			unset($data[$key]->product_id);
		}

		return $data;
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

		foreach($item->data as $compare) {
			if($compare->product->id === $data['product_id']) {
				$data['quantity'] += $compare->quantity;
			}
		}

		$item->data = json_encode(array($data));

		return $item->save();
	}

	public static function items() {
		if(!Session::get('aviate_basket')) {
			self::generate();
		}

		return self::getBasket()->data;
	}

	public static function itemCount($quantity = 0) {
		if(self::items()) {
			foreach(self::items() as $item) {
				$quantity += $item->quantity;
			}
		}

		return $quantity;
	}

	public static function priceCount($price = 0) {
		if(self::items()) {
			foreach(self::items() as $item) {
				$price += $item->price;
			}
		}

		return Currency::price($price);
	}
}
