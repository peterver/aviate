<?php

class Basket extends Eloquent {

	protected $table = 'baskets';
	protected $fillable = array('session', 'data');

	public static $hash;
	public static $basket;

	public function getDataAttribute($value) {
		$data = array();

		//  If it's 2 characters or less, it's
		//  not a valid JSON string.
		if(empty($value) or strlen($value) < 3) return $data;

		foreach(json_decode($value) as $key => $row) {
			$data[(int) $key] = $row;
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

	public static function getContents() {
		$products = array();

		if(!self::items()) {
			return $products;
		}

		foreach(self::items() as $product => $quantity) {
			$product = Products::whereId($product)->first();
			$product->total_price = $product->price * $quantity;
			$product->quantity = $quantity;

			$products[] = $product;
		}

		return $products;
	}

	public static function add($product, $quantity = 1) {
		$item = self::getBasket();
		$data = $item->data;

		if(isset($data[$product])) {
			//  Add our quantity
			$quantity += $data[$product];
		}

		$data[$product] = $quantity;

		$item->data = json_encode($data);

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
			foreach(self::items() as $product => $amount) {
				$quantity += $amount;
			}
		}

		return $quantity;
	}

	public static function priceCount($price = 0) {
		foreach(self::getContents() as $product) {
			$price += $product->total_price;
		}

		return Currency::price($price);
	}
}
